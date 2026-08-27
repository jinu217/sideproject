<?php
// 05_03_view.php : 프로젝트 정리 완료 + 팀원 후기 유도

// 1) project_id 받기
$project_id = 0;

if (isset($_GET['project_id'])) {
    $project_id = (int)$_GET['project_id'];
} elseif (isset($_POST['project_id'])) {
    $project_id = (int)$_POST['project_id'];
}

if ($project_id <= 0) {
    // 데모용 기본값
    $project_id = 1;
}

// 2) reviewer_id (로그인 유저 ID라고 가정)
//   나중에 로그인 붙으면 세션에서 가져오면 됨.
$reviewer_id = 1;
?>

<div class="div">
    <div class="group-parent">
        <div class="group-container">
            <img src="../img/finish_logo.svg" class="vector-parent">                        
        </div>
        <div class="preview-parent">
            <b class="preview">프로젝트가 정리되었어요!</b>
            <div class="preview2">프로젝트의 주요 활동 정보가 기록되었어요.</div>
        </div>
    </div>
    <div class="inner">
        <div class="frame-parent">
            <div class="parent">
                <div class="div2">프로젝트 기간</div>
                <div class="wrapper">
                    <div class="ux-ui">2025.10 ~ 2025. 11</div>
                </div>
            </div>
            <div class="parent">
                <div class="div2">참여 팀원</div>
                <div class="wrapper">
                    <div class="ux-ui">6명</div>
                </div>
            </div>
            <div class="parent">
                <div class="div2">최종 산출물 </div>
                <div class="wrapper">
                    <div class="ux-ui">UX기획, UI디자인</div>
                </div>
            </div>
        </div>
    </div>
    <div class="child">
        <div class="frame-group">
            <div class="frame-container">
                <div class="frame">
                    <div class="ux-ui">팀원 후기를 작성해볼까요?</div>
                </div>
                <div class="div8">어떤 점이 좋았는지 , 아쉬웠는지 남겨두면<br>다음번 프로젝트에 큰 도움이 돼요. </div>
            </div>
            <div class="buttons-wrapper">
                <div class="buttons" id="buttonsContainer">
                    <div class="basic-icon-set">
                    </div>
                    <b class="b">팀원 후기 작성하기</b>
                    <div class="basic-icon-set">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="inner2" id="frameContainer3">
        <div class="buttons-container">
            <div class="buttons2">
                <div class="basic-icon-set3">
                </div>
                <b class="b2">홈으로 돌아가기</b>
                <div class="basic-icon-set3">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var buttonsContainer = document.getElementById("buttonsContainer");
    if(buttonsContainer) {
        buttonsContainer.addEventListener("click", function (e) {
            const projectId  = <?= (int)$project_id ?>;
            const reviewerId = <?= (int)$reviewer_id ?>;

            // 🔥 05_04_review.php 로 project_id + reviewer_id 전달
            window.location.href =
                "05_04_review.php"
                + "?project_id="  + encodeURIComponent(projectId)
                + "&reviewer_id=" + encodeURIComponent(reviewerId);
        });
    }
    
    var frameContainer3 = document.getElementById("frameContainer3");
    if(frameContainer3) {
        frameContainer3.addEventListener("click", function (e) {
            window.location.href = "00_home.php";
        });
    }
</script>
