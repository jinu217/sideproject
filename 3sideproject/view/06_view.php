<?php
include_once 'connect.php';

// ----------------------
// 1) 프로필 대상 유저
// ----------------------
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

if ($user_id <= 0) {
    echo "<div style='padding:20px; font-family:Pretendard;'>유효한 유저 ID가 없습니다.</div>";
    exit;
}

// 유저 정보
$sql = "SELECT id, name, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    echo "<div style='padding:20px; font-family:Pretendard;'>존재하지 않는 유저입니다.</div>";
    exit;
}

// ----------------------
// 2) 리뷰 목록 + 통계 (동료후기 탭에서 사용)
// ----------------------
$sql = "
    SELECT
        pr.rating,
        pr.comment,
        pr.is_anonymous,
        pr.created_at,
        u.name AS reviewer_name,
        p.title AS project_title
    FROM peer_reviews pr
    JOIN users u    ON pr.reviewer_id = u.id
    JOIN projects p ON pr.project_id = p.id
    WHERE pr.target_user_id = ?
    ORDER BY pr.created_at DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();

$reviews = [];
$sumRating = 0;
$positiveCount = 0; // 4점 이상
while ($row = $res->fetch_assoc()) {
    $reviews[] = $row;
    $sumRating += (int)$row['rating'];
    if ((int)$row['rating'] >= 4) {
        $positiveCount++;
    }
}
$stmt->close();

$reviewCount   = count($reviews);
$avgRating     = $reviewCount > 0 ? $sumRating / $reviewCount : 0;
$avgDisplay    = $reviewCount > 0 ? number_format($avgRating, 1) : "0.0";
$positiveRate  = $reviewCount > 0 ? round($positiveCount * 100 / $reviewCount) : 0;

// 상대 시간 표시용 (예: "1일 전", "2주 전")
function relativeTimeKor($datetimeStr) {
    $ts = strtotime($datetimeStr);
    if ($ts === false) return "";

    $diff = time() - $ts;
    if ($diff < 60) return "방금 전";
    if ($diff < 3600) return floor($diff / 60) . "분 전";
    if ($diff < 86400) return floor($diff / 3600) . "시간 전";
    if ($diff < 86400 * 7) return floor($diff / 86400) . "일 전";
    if ($diff < 86400 * 30) return floor($diff / (86400 * 7)) . "주 전";
    return date("Y.m.d", $ts);
}

// ----------------------
// 3) 탭 결정
// ----------------------
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'reviews';
$validTabs = ['profile', 'project', 'portfolio', 'reviews'];
if (!in_array($tab, $validTabs)) {
    $tab = 'reviews';
}

$badgeText = 'Hipster'; // 기본값

if ($user['role'] === '개발자') {
    $badgeText = 'Hacker';
} elseif ($user['role'] === '디자이너') {
    $badgeText = 'Hipster';
} elseif ($user['role'] === '기획' || $user['role'] === '기획자') {
    $badgeText = 'Hustler';
}
?>

<!-- 🔹 상단 프로필 카드 (공통 영역) -->
<div style="width: 100%; padding-top: 30px; padding-bottom: 15px; background: white; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 30px; display: inline-flex">
    <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex">
        <!-- 상단 네비(뒤로가기/공유/설정) -->
        <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; padding-top: 12px; padding-bottom: 12px; justify-content: space-between; align-items: flex-start; display: inline-flex">
            <img src="img/arrow_left.svg" style="width: 24px; height: 24px">
            <div style="justify-content: flex-start; align-items: center; gap: 6px; display: flex">
                <img src="img/share.svg" style="width: 24px; height: 24px">
                <img src="img/settings.svg" style="width: 24px; height: 24px;">
            </div>
        </div>

        <!-- 프로필 카드 -->
        <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; padding-top: 20px; padding-bottom: 20px; background: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08); flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
            <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 14px; display: flex">
                <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 16px; display: inline-flex">
                    <img style="width: 94px; height: 89px; border-radius: 20px" src="https://placehold.co/94x89" />
                    <div style="align-self: stretch; padding-top: 6px; padding-bottom: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
                        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 7px; display: flex">
                            <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
                                <div style="padding-bottom:1px; padding-left: 6px; padding-right: 6px; background: var(--tishoo-Cyan, #1E78FF); border-radius: 8px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: right; color: white; font-size: 11px; font-family: Pretendard; font-weight: 500; line-height: 14.30px; word-wrap: break-word">
                                        <?= htmlspecialchars($badgeText) ?>
                                    </div>
                                </div>
                            </div>
                            <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 5px; display: flex">
                                <!-- 프로필 이름 -->
                                <div style="color: black; font-size: 20px; font-family: Pretendard; font-weight: 700; line-height: 18px; word-wrap: break-word">
                                    <?= htmlspecialchars($user['name']) ?>
                                </div>
                                <!-- 한 줄 소개: role 사용 -->
                                <div style="color: #565656; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 18px; word-wrap: break-word">
                                    <?= htmlspecialchars($user['role']) ?>
                                </div>
                            </div>
                        </div>
                        <div style="justify-content: flex-start; align-items: flex-start; gap: 7px; display: inline-flex">
                            <div style="justify-content: flex-start; align-items: center; gap: 2px; display: flex">
                                <div style="justify-content: center; display: flex; flex-direction: column; color: black; font-size: 11px; font-family: Pretendard; font-weight: 400; word-wrap: break-word">팔로잉</div>
                                <div style="justify-content: center; display: flex; flex-direction: column; color: black; font-size: 11px; font-family: Pretendard; font-weight: 700; word-wrap: break-word">123</div>
                            </div>
                            <div style="justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                                <div style="justify-content: flex-start; align-items: center; gap: 2px; display: flex">
                                    <div style="justify-content: center; display: flex; flex-direction: column; color: black; font-size: 11px; font-family: Pretendard; font-weight: 400; word-wrap: break-word">팔로워</div>
                                    <div style="justify-content: center; display: flex; flex-direction: column; color: black; font-size: 11px; font-family: Pretendard; font-weight: 700; word-wrap: break-word">123</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 티슈력 영역 -->
                <div style="align-self: stretch; padding-left: 4px; padding-right: 10px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 8px; display: flex">
                        <div style="padding-bottom: 8px; justify-content: flex-start; align-items: center; gap: 4px; display: inline-flex">
                            <img src="img/tishoo_power.svg">
                            <div style="position: relative; display:inline-flex; align-items:center;">
                                <div style="padding-left: 4px; padding-right: 4px; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 12px; font-family: Pretendard; font-weight: 600; line-height: 18px;">티슈력</div>
                                <div id="tishooInfoBtn" style="width: 18px; height: 18px; position: relative; cursor:pointer;">
                                    <img src="img/tishoo_power_i.svg" style="width: 15px; height: 15px; left: 1.5px; top: 1.5px; position: absolute; background: var(--Neutral-Color-4">
                                </div>
                                <div id="tishooTooltip" data-arrow="left" data-color="black" data-description="off" style="display:none; position: absolute; justify-content: flex-start; align-items: center; display: flex">
                                    <img src="img/tishoo_power_i2.svg" style="padding-left:64px">
                                    <div style="width: 169px; padding: 6px 8px; background: #333; overflow: hidden; border-radius: 4px; flex-direction: column; justify-content: flex-start; align-items: center; display: inline-flex">
                                        <div style="text-align: center; color: white; font-size: 12px; font-family: Spoqa Han Sans Neo; font-weight: 400; line-height: 18px;">프로젝트 평균 완주율을 나타내요</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="align-self: stretch; height: 20.73px; justify-content: space-between; align-items: center; display: inline-flex">
                            <div style="width: 266.47px; height: 20.73px; background: #FEFBFD; box-shadow: inset 0px 2px 14px rgba(0, 0, 0, 0.08); border-radius: 15px">
                                <div style="width: 215.46px; height: 20.73px; background: linear-gradient(90deg, var(--tishoo-Magenta, #FB23CB) 0%, #1A77FD 100%); border-radius: 15px"></div>
                            </div>
                            <?php
                                // 5점 만점을 100점 스케일로
                                $tishooScore = $reviewCount > 0 ? round($avgRating * 20) : 0;
                            ?>
                            <div style="width: 35px; text-align: right; color: black; font-size: 14px; font-family: AppleSDGothicNeoB00; font-weight: 400; line-height: 18px;">
                                <?= $tishooScore ?>점
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 채팅/협업 제안 버튼 -->
            <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
                <div style="flex: 1 1 0; height: 12px; padding: 16px; background: #F8F8F8; overflow: hidden; border-radius: 99px; outline: 1px var(--Neutral-Color-2, #DBDBDB) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 4px; display: flex">
                    <div style="color: var(--Neutral-Color-6, #757575); font-size: 12px; font-family: Pretendard; font-weight: 800; line-height: 18px;">채팅하기</div>
                </div>
                <div style="flex: 1 1 0; height: 12px; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: flex">
                    <div style="color: white; font-size: 14px; font-family: Spoqa Han Sans Neo; font-weight: 700; line-height: 20px;">협업제안 보내기</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 탭 헤더 -->
<div style="width: 375px; padding-left: 15px; background: white; border-bottom: 1px #E2E8F0 solid; justify-content: flex-start; align-items: flex-start; gap: 30px; display: inline-flex">

    <!-- ⚠ 여기 URL 꼭 06_user_profile.php 로! -->
    <!-- 프로필 -->
    <div
        onclick="location.href='06_user_profile.php?user_id=<?= $user_id ?>&tab=profile'"
        style="
            padding-top: 14px; padding-bottom: 14px;
            border-bottom: <?= ($tab === 'profile') ? '2px var(--tishoo-Cyan, #1E78FF) solid' : '1px #E2E8F0 solid' ?>;
            justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;
        "
    >
        <div style="
            color: <?= ($tab === 'profile') ? 'var(--tishoo-Cyan, #1E78FF)' : 'var(--Neutral-Color-6, #757575)' ?>;
            font-size: 17px; font-family: Pretendard;
            font-weight: <?= ($tab === 'profile') ? '600' : '400' ?>;
            line-height: 23.80px;
        ">
            프로필
        </div>
    </div>

    <!-- 프로젝트 -->
    <div
        onclick="location.href='06_user_profile.php?user_id=<?= $user_id ?>&tab=project'"
        style="
            padding-top: 14px; padding-bottom: 14px;
            border-bottom: <?= ($tab === 'project') ? '2px var(--tishoo-Cyan, #1E78FF) solid' : '1px #E2E8F0 solid' ?>;
            justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;
        "
    >
        <div style="
            color: <?= ($tab === 'project') ? 'var(--tishoo-Cyan, #1E78FF)' : 'var(--Neutral-Color-6, #757575)' ?>;
            font-size: 17px; font-family: Pretendard;
            font-weight: <?= ($tab === 'project') ? '600' : '400' ?>;
            line-height: 23.80px;
        ">
            프로젝트
        </div>
    </div>

    <!-- 포트폴리오 -->
    <div
        onclick="location.href='06_user_profile.php?user_id=<?= $user_id ?>&tab=portfolio'"
        style="
            padding-top: 14px; padding-bottom: 14px;
            border-bottom: <?= ($tab === 'portfolio') ? '2px var(--tishoo-Cyan, #1E78FF) solid' : '1px #E2E8F0 solid' ?>;
            justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;
        "
    >
        <div style="
            color: <?= ($tab === 'portfolio') ? 'var(--tishoo-Cyan, #1E78FF)' : 'var(--Neutral-Color-6, #757575)' ?>;
            font-size: 17px; font-family: Pretendard;
            font-weight: <?= ($tab === 'portfolio') ? '600' : '400' ?>;
            line-height: 23.80px;
        ">
            포트폴리오
        </div>
    </div>

    <!-- 동료후기 -->
    <div
        onclick="location.href='06_user_profile.php?user_id=<?= $user_id ?>&tab=reviews'"
        style="
            padding-top: 14px; padding-bottom: 14px;
            border-bottom: <?= ($tab === 'reviews') ? '2px var(--tishoo-Cyan, #1E78FF) solid' : '1px #E2E8F0 solid' ?>;
            justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;
        "
    >
        <div style="
            color: <?= ($tab === 'reviews') ? 'var(--tishoo-Cyan, #1E78FF)' : 'var(--Neutral-Color-6, #757575)' ?>;
            font-size: 17px; font-family: Pretendard;
            font-weight: <?= ($tab === 'reviews') ? '600' : '400' ?>;
            line-height: 23.80px;
        ">
            동료후기
        </div>
    </div>
</div>

<?php
// 🔹 탭별 컨텐츠 include (여기서 view/ 폴더 안의 파일 불러옴)
switch ($tab) {
    case 'profile':
        include 'view/06_01_view.php';
        break;
    case 'project':
        include 'view/06_02_view.php';
        break;
    case 'portfolio':
        include 'view/06_03_view.php';
        break;
    case 'reviews':
    default:
        include 'view/06_04_view.php';
        break;
}
?>

<!-- 🔹 공통 JS -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 평균 별점 → 상단 별 5개 채우기 (동료후기 탭에서만 averageStars가 있음)
    const avg = <?= json_encode((float)$avgRating) ?>;
    const container = document.getElementById("averageStars");
    if (container) {
        container.innerHTML = "";
        for (let i = 1; i <= 5; i++) {
            const img = document.createElement("img");
            img.style.width  = "20px";
            img.style.height = "20px";

            const starScore = avg - (i - 1);

            if (starScore >= 0.75) {
                img.src = "img/star_on.svg";
            } else if (starScore >= 0.25) {
                img.src = "img/star_half.svg";
            } else {
                img.src = "img/star_off.svg";
            }

            container.appendChild(img);
        }
    }

    // 티슈력 툴팁 토글
    const infoBtn = document.getElementById("tishooInfoBtn");
    const tooltip = document.getElementById("tishooTooltip");

    if (infoBtn && tooltip) {
        tooltip.style.display = "none";

        infoBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            tooltip.style.display =
                (tooltip.style.display === "none" || tooltip.style.display === "")
                    ? "flex"
                    : "none";
        });

        document.addEventListener("click", function (event) {
            if (!tooltip.contains(event.target) && event.target !== infoBtn) {
                tooltip.style.display = "none";
            }
        });
    }
});
</script>
