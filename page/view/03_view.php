<?php
// ===========================
// 03_view.php : 마이페이지 내용
// ===========================
include_once '../connect.php';

// 1) 현재 유저 ID
$current_user_id = isset($_GET['user']) ? (int)$_GET['user'] : 1;

// 2) 유저 기본 정보 (users + user_profiles + positions)
$sql = "
    SELECT 
        u.id,
        u.name,
        u.role,
        p.nickname,
        p.profile_image_url,
        pos.name_ko AS position_name
    FROM users u
    LEFT JOIN user_profiles p ON p.user_id = u.id
    LEFT JOIN positions pos ON pos.id = p.position_id
    WHERE u.id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// 3) 유저 정보 없으면 기본값
if (!$user) {
    $user = [
        'name'              => '이름 없음',
        'nickname'          => null,
        'role'              => '역할 정보 없음',
        'position_name'     => '포지션 없음',
        'profile_image_url' => null,
    ];
}

// ===========================
// 4) 티슈력 계산 (peer_reviews 기반 : 평균 평점 × 20)
// ===========================
$sql = "
    SELECT rating
    FROM peer_reviews
    WHERE target_user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$res = $stmt->get_result();

$sumRating   = 0;
$reviewCount = 0;

while ($row = $res->fetch_assoc()) {
    $reviewCount++;
    $sumRating += (float)$row['rating'];
}
$stmt->close();

$avgRating   = $reviewCount > 0 ? ($sumRating / $reviewCount) : 0;   // 1~5
$tishooScore = $reviewCount > 0 ? (int)round($avgRating * 20) : 0;   // 0~100점

// ===========================
// 5) 헤더/칩 파생 값들 (06_view 방식 그대로)
// ===========================

// 유저 정보 기본값 방어
$user_name = isset($user['name']) ? $user['name'] : '이름 없음';
$user_role = isset($user['role']) ? $user['role'] : '역할 정보 없음';

// 역할에 따른 Hacker / Hipster / Hustler 매핑 (06_view.php와 동일)
$chipLabel = '개발자'; // 기본값
$roleText  = $user_role;

// 한글 role에 "개발" / "디자인" / "기획" / "PM" 같은 단어가 있다고 가정
if (mb_stripos($user_role, '개발') !== false) {
    $chipLabel = '개발자';
} elseif (
    mb_stripos($user_role, '디자인') !== false ||
    mb_stripos($user_role, '디자이너') !== false ||
    mb_stripos($user_role, 'UI/UX') !== false
) {
    $chipLabel = '디자이너';
} elseif (
    mb_stripos($user_role, '기획') !== false ||
    mb_stripos($user_role, 'PM') !== false
) {
    $chipLabel = '기획자';
}

// 프로필 이미지 (없으면 기본 이미지)
$profileImage = !empty($user['profile_image_url'])
    ? $user['profile_image_url']
    : '../img/default_profile.png';

// 표시할 이름 (닉네임 > 이름 우선)
$displayName = !empty($user['nickname']) ? $user['nickname'] : $user['name'];

// 포지션 텍스트 (positions.name_ko > users.role)
$positionText = !empty($user['position_name']) ? $user['position_name'] : $user['role'];

// 게이지바 폭(%)
$gaugePercent = max(0, min(100, $tishooScore));

// ===========================
// 6) 유저 변경용 유저 리스트 (닉네임이 있으면 닉네임, 없으면 이름)
// ===========================
$userList = [];

$sqlUsers = "
    SELECT 
        u.id,
        COALESCE(p.nickname, u.name) AS display_name
    FROM users u
    LEFT JOIN user_profiles p ON p.user_id = u.id
    ORDER BY u.id ASC
";
$stmt = $conn->prepare($sqlUsers);
$stmt->execute();
$resUsers = $stmt->get_result();

while ($row = $resUsers->fetch_assoc()) {
    $userList[] = $row;
}
$stmt->close();
?>

<div class="mypage">
    <div class="header">
        <div class="heading-1">
            <b class="b">마이페이지</b>
        </div>
        <div class="container">
            <img src="../img/bell.svg" class="icon" alt="" id="bell">
            <img src="../img/setting.svg" class="icon2" alt="">
        </div>
    </div>

    <div class="container2">
        <div class="container3">
            <div class="container4">
                <!-- ✅ 프로필 이미지 (DB 연동) -->
                <img class="container-icon" alt=""
                     src="<?php echo htmlspecialchars($profileImage, ENT_QUOTES, 'UTF-8'); ?>">

                <div class="container5">
                    <div class="container6">
                        <!-- ✅ 역할에 따른 Hacker / Hipster / Hustler 칩 (06_view와 동일 로직) -->
                        <div class="text">
                            <b class="hipster">
                                <?= htmlspecialchars($chipLabel, ENT_QUOTES, 'UTF-8'); ?>
                            </b>
                        </div>

                        <!-- ✅ 이름 / 닉네임 (DB 연동) -->
                        <div class="text2">
                            <b class="b2">
                                <?php echo htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8'); ?>
                            </b>
                        </div>

                        <img src="../img/arrow_right.svg" class="icon3" alt="" id="user_profile">
                    </div>

                    <!-- ✅ 포지션 (DB 연동) -->
                    <div class="paragraph">
                        <div class="uiux">
                            <?php echo htmlspecialchars($positionText, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ 티슈력 박스 (peer_reviews 기반) -->
            <div class="frame-parent">
                <div class="frame-group">
                    <div class="parent" id="frameContainer">
                        <b class="b3">🧻</b>
                        <b class="b3">티슈력</b>
                        <img src="../img/tishoo_power_i.svg" class="error-icon" alt="">
                    </div>
                    <b class="b5">
                        <?php echo $tishooScore; ?>점
                    </b>
                </div>

                <!-- 게이지 바 (티슈력에 따라 width 조정) -->
                <div class="container7">
                    <div class="container8"
                         style="width: <?php echo $gaugePercent; ?>%;"></div>
                </div>

                <div class="frame-container">
                    <div class="wrapper">
                        <b class="b6">상위 12%</b>
                    </div>
                    <div class="group">
                        <div class="div">다음 레벨까지</div>
                        <div class="text3">
                            <b class="b7">18점</b>
                        </div>
                        <div class="div">남았어요!</div>
                    </div>
                </div>
            </div>

            <div class="container9">
                <div class="button" id="profile_setting">
                    <b class="b8">프로필 수정</b>
                </div>
                <div class="button2">
                    <b class="b8">내 포트폴리오</b>
                </div>
            </div>
        </div>

        <div class="container-wrapper">
            <div class="container10">
                <div class="heading-2">
                    <b class="b3">내 프로젝트 현황</b>
                </div>
                <div class="container11">
                    <div class="container12">
                        <div class="container13">
                            <div class="div3">3</div>
                        </div>
                        <div class="container14">
                            <div class="div4">지원 현황</div>
                        </div>
                    </div>
                    <div class="container15"></div>
                    <div class="container16">
                        <div class="container17">
                            <div class="div3">2</div>
                        </div>
                        <div class="container18">
                            <div class="div4">받은 제안</div>
                        </div>
                        <div class="container19"></div>
                    </div>
                    <div class="container15"></div>
                    <div class="container12">
                        <div class="container13">
                            <div class="div3">1</div>
                        </div>
                        <div class="container14">
                            <div class="div8">진행중</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-container">
            <div class="container24">
                <div class="container25">
                    <div class="container26">
                        <div class="container-icon2-1" alt="">
                            <img src="../img/my_profile_icon_1.svg">
                        </div>
                        <div class="text4">
                            <div class="square">관심 프로젝트</div>
                        </div>
                    </div>
                    <img src="../img/arrow_right.svg" class="container-icon3" alt="">
                </div>
                <div class="container25">
                    <div class="container28">
                        <div class="container-icon2-2" alt="">
                            <img src="../img/my_profile_icon_2.svg">
                        </div>
                        <div class="text5">
                            <div class="square">관심 팀원 / 멘토</div>
                        </div>
                    </div>
                    <img src="../img/arrow_right.svg" class="container-icon3" alt="">
                </div>
                <div class="container29">
                    <div class="container30">
                        <div class="container-icon2-3" alt="">
                            <img src="../img/my_profile_icon_3.svg">
                        </div>
                        <div class="text5">
                            <div class="square">획득한 배지</div>
                        </div>
                    </div>
                    <div class="container31">
                        <div class="text7">
                            <div class="div12">3개</div>
                        </div>
                        <img src="../img/arrow_right.svg" class="icon3" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-container">
            <div class="container32">
                <div class="container25">
                    <div class="container34">
                        <div class="container-icon2-4" alt="">
                            <img src="../img/my_profile_icon_4.svg">
                        </div>
                        <div class="text8">
                            <div class="square">내가 쓴 글 (Square)</div>
                        </div>
                    </div>
                    <img src="../img/arrow_right.svg" class="icon3" alt="">
                </div>
                <div class="container25">
                    <div class="container30">
                        <div class="container-icon2-4" alt="">
                            <img src="../img/my_profile_icon_5.svg">
                        </div>
                        <div class="text5">
                            <div class="square">작성한 후기</div>
                        </div>
                    </div>
                    <img src="../img/arrow_right.svg" class="icon3" alt="">
                </div>
                <div class="container29">
                    <div class="container38">
                        <div class="container-icon2-4" alt="">
                            <img src="../img/my_profile_icon_6.svg">
                        </div>
                        <div class="text10">
                            <div class="square">공지사항 / 이벤트</div>
                        </div>
                    </div>
                    <img src="../img/arrow_right.svg" class="icon3" alt="">
                </div>
            </div>
        </div>

        <div class="frame-div">
            <div class="container39">
                <div class="container40">
                    <div class="text11">
                        <div class="div15">이용약관</div>
                    </div>
                    <div class="text12">
                        <div class="div15">개인정보처리방침</div>
                    </div>
                    <div class="text11">
                        <div class="div15">고객센터</div>
                    </div>
                </div>
                <!-- 🔽 로그아웃 버튼에 id 추가 -->
                <div class="button3" id="logout-btn">
                    <img src="../img/logout.svg" class="icon8" alt="">
                    <div class="text14">
                        <div class="div18">로그아웃</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tishoo-modal-backdrop" class="tishoo-modal-backdrop" style="display:none;">
    <div class="tishoo-modal-inner">
        <iframe
            id="tishoo-modal-iframe"
            class="tishoo-modal-iframe"
            src="03_01_tishoo_power.php"
            frameborder="0">
        </iframe>
    </div>
</div>

<!-- 🔽 유저 선택 모달 -->
<div id="user-switch-modal" 
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4);
            align-items:center; justify-content:center; z-index:9999;">
    
    <div style="width:260px; background:#fff; border-radius:12px; padding:20px;
                display:flex; flex-direction:column; gap:14px; font-family:Pretendard;">
        
        <b style="font-size:18px;">유저 변경</b>

        <?php if (!empty($userList)): ?>
            <?php foreach ($userList as $u): ?>
                <div class="user-item"
                     data-user="<?= (int)$u['id']; ?>"
                     style="padding:10px 14px; background:#f3f4f6; border-radius:8px; cursor:pointer;">
                    👤 <?= htmlspecialchars($u['display_name'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="font-size:14px; color:#777;">
                다른 유저가 없습니다.
            </div>
        <?php endif; ?>

        <div id="closeUserModal"
             style="text-align:center; padding:10px; cursor:pointer; color:#777;">
            닫기
        </div>
    </div>
</div>

<script>
    // 🔽 로그아웃 버튼 클릭 시 모달 열기
    var logoutBtn = document.getElementById("logout-btn");
    var userModal = document.getElementById("user-switch-modal");

    if (logoutBtn && userModal) {
        logoutBtn.addEventListener("click", function () {
            userModal.style.display = "flex";   // 페이지 로드시엔 안 보이고, 여기서만 보이게
        });
    }

    // 🔽 모달 닫기 버튼
    var closeUserModal = document.getElementById("closeUserModal");
    if (closeUserModal && userModal) {
        closeUserModal.addEventListener("click", function () {
            userModal.style.display = "none";
        });
    }

    // 🔽 모달 바깥(배경) 클릭 시 닫기 (옵션)
    if (userModal) {
        userModal.addEventListener("click", function(e) {
            if (e.target === userModal) {
                userModal.style.display = "none";
            }
        });
    }

    // 🔽 유저 선택 시 페이지 리로드
    var userItems = document.querySelectorAll(".user-item");
    userItems.forEach(function(item) {
        item.addEventListener("click", function() {
            var selectedUser = this.getAttribute("data-user");
            if (selectedUser) {
                window.location.href = "03_mypage.php?user=" + selectedUser;
            }
        });
    });

    // 기존 마이페이지 JS들
    var iconBell = document.getElementById("bell");
    if(iconBell) {
    iconBell.addEventListener("click", function (e) {
        window.location.href = "07_notification.php?user=<?= $current_user_id ?>";
    });
    }

    var tishooBox      = document.getElementById("frameContainer");
    var modalBackdrop  = document.getElementById("tishoo-modal-backdrop");

    if (tishooBox && modalBackdrop) {
        tishooBox.addEventListener("click", function (e) {
            modalBackdrop.style.display = "flex";
            document.body.style.overflow = "hidden";
        });
    }

    window.addEventListener("message", function(event) {
        if (event.data && event.data.action === "closeTishooModal") {
            var modalBackdrop = document.getElementById("tishoo-modal-backdrop");
            if (modalBackdrop) {
                modalBackdrop.style.display = "none";
                document.body.style.overflow = "";
            }
        }
    });

    var profileSettingBtn = document.getElementById("profile_setting");
    if (profileSettingBtn) {
        profileSettingBtn.addEventListener("click", function (e) {
            window.location.href = "03_02_mypage_setting.php?user=<?= $current_user_id ?>";
        });
    }

    var userProfileArrow = document.getElementById("user_profile");
    if (userProfileArrow) {
        userProfileArrow.addEventListener("click", function (e) {
            window.location.href = "09_user_profile.php?user=<?= $current_user_id ?>";
        });
    }
</script>
