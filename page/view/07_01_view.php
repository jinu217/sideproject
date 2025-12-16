<?php
// 07_01_project_finish.php

include_once '../connect.php';

// 1) 현재 유저 ID (?user=... 없으면 1)
$current_user_id = isset($_GET['user']) ? (int)$_GET['user'] : 1;
if ($current_user_id <= 0) {
    $current_user_id = 1;
}

// 2) 프로젝트 ID (알림에서 넘겨줄 수 있고, 없으면 1번 프로젝트로 가정)
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 1;

// ===========================
// 3) 프로젝트 정보 불러오기 (projects)
// ===========================
$projectTitle   = '프로젝트 이름 미정';
$periodText     = '진행 기간 정보 없음';
$startDateText  = '';
$endDateText    = '';

$sqlProject = "
    SELECT title, start_date, end_date
    FROM projects
    WHERE id = ?
";
$stmt = $conn->prepare($sqlProject);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$res  = $stmt->get_result();
$rowP = $res->fetch_assoc();
$stmt->close();

if ($rowP) {
    $projectTitle = $rowP['title'];

    if (!empty($rowP['start_date'])) {
        $startDateText = date('Y.m.d', strtotime($rowP['start_date']));
    }
    if (!empty($rowP['end_date'])) {
        $endDateText   = date('Y.m.d', strtotime($rowP['end_date']));
    }

    if ($startDateText && $endDateText) {
        $periodText = $startDateText . ' — ' . $endDateText;
    } elseif ($startDateText) {
        $periodText = $startDateText . ' ~';
    } elseif ($endDateText) {
        $periodText = '~ ' . $endDateText;
    }
}

// ===========================
// 4) 참여 팀원 정보 (project_members + users + user_profiles)
// ===========================
$memberCount      = 0;
$memberImageUrls  = [];   // 최대 3명 정도만 썸네일로 쓸 예정
$defaultProfile   = '../img/default_profile.png';

$sqlMembers = "
    SELECT 
        pm.user_id,
        u.name,
        up.profile_image_url
    FROM project_members pm
    JOIN users u ON u.id = pm.user_id
    LEFT JOIN user_profiles up ON up.user_id = pm.user_id
    WHERE pm.project_id = ?
    ORDER BY pm.is_leader DESC, pm.id ASC
";
$stmt = $conn->prepare($sqlMembers);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$resM = $stmt->get_result();

while ($rowM = $resM->fetch_assoc()) {
    $memberCount++;

    if (count($memberImageUrls) < 3) {
        $img = !empty($rowM['profile_image_url']) ? $rowM['profile_image_url'] : $defaultProfile;
        $memberImageUrls[] = $img;
    }
}
$stmt->close();

// 필요한 만큼만 안전하게 꺼내기
$img1 = isset($memberImageUrls[0]) ? $memberImageUrls[0] : $defaultProfile;
$img2 = isset($memberImageUrls[1]) ? $memberImageUrls[1] : $defaultProfile;
$img3 = isset($memberImageUrls[2]) ? $memberImageUrls[2] : $defaultProfile;

?>

<div class="div">
    <div class="inner">
        <div class="preview-wrapper">
            <b class="preview">프로젝트가 무사히 끝났어요! </b>
        </div>
    </div>

    <div class="container">
        <div class="container2">
            <div class="container-icon" alt="">
                <img src="../img/finish_icon1.svg">
            </div>
            <div class="container3">
                <div class="text">
                    <div class="div2">프로젝트 이름</div>
                </div>
                <div class="text2">
                    <!-- ✅ DB에서 가져온 프로젝트 제목 -->
                    <div class="ai">
                        <?= htmlspecialchars($projectTitle, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container2">
            <div class="container-icon" alt="">
                <img src="../img/finish_icon2.svg">
            </div>
            <div class="container5">
                <div class="text3">
                    <div class="div2">진행 기간</div>
                </div>
                <div class="text4">
                    <!-- ✅ DB에서 가져온 진행 기간 -->
                    <div class="div4">
                        <?= htmlspecialchars($periodText, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container6">
            <div class="container7">
                <div class="container-icon" alt="">
                    <img src="../img/finish_icon3.svg">
                </div>
                <div class="container8">
                    <div class="text5">
                        <div class="div2">참여 팀원</div>
                    </div>
                    <div class="text6">
                        <!-- ✅ DB에서 계산한 팀원 수 -->
                        <div class="div2">총 <?= $memberCount ?>명</div>
                    </div>
                </div>
            </div>
            <div class="container9">
                <!-- ✅ 참여 팀원 프로필 이미지 (최대 3명) -->
                <img class="container-icon4" alt=""
                     src="<?= htmlspecialchars($img1, ENT_QUOTES, 'UTF-8'); ?>">
                <img class="container-icon5" alt=""
                     src="<?= htmlspecialchars($img2, ENT_QUOTES, 'UTF-8'); ?>">
                <img class="container-icon6" alt=""
                     src="<?= htmlspecialchars($img3, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
        </div>
    </div>

    <div class="container10">
        <div class="container11">
            <div class="container12"></div>
            <div class="container13"></div>
        </div>
        <div class="container14">
            <div class="container15">
                <div class="container16">
                    <div class="heading-3">
                        <div class="div7">팀원 리뷰 남기기</div>
                        <div class="text7"></div>
                    </div>
                    <div class="paragraph">
                        <div class="div8">함께 고생한 동료들에게</div>
                        <div class="div9">따뜻한 응원을 전해주세요 💌</div>
                    </div>
                </div>
            </div>
            <div class="button" id="buttonContainer">
                <div class="text8">
                    <div class="div2">리뷰 작성하러 가기</div>
                </div>
                <div class="container-icon7" alt="">
                    <img src="../img/finish_arrow.svg">
                </div>
            </div>
        </div>
    </div>

    <div class="button2">
        <img class="icon" alt="">
        <div class="text9">
            <div class="div2-1">나중에 하기</div>
        </div>
    </div>
</div>

<script>
    // ✅ 리뷰 작성 버튼: reviewer_id = 현재 유저 id
    var buttonContainer = document.getElementById("buttonContainer");
    if (buttonContainer) {
        buttonContainer.addEventListener("click", function (e) {
            // project_id, reviewer_id, user 모두 GET으로 넘김
            window.parent.location.href =
                "07_02_review.php"
                + "?project_id=<?= $project_id ?>"
                + "&reviewer_id=<?= $current_user_id ?>"
                + "&user=<?= $current_user_id ?>";
        });
    }

    // ✅ 나중에 하기 (홈으로) → 모달 닫기
    var laterButton = document.querySelector(".button2");
    if (laterButton) {
        laterButton.addEventListener("click", function (e) {
            // 부모(07_notification.php)에게 모달 닫으라고 신호 보내기
            window.parent.postMessage({ action: "closeProjectFinishModal" }, "*");
        });
    }
</script>
