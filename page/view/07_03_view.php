<?php
// 07_03_view.php : 팀원 후기 작성하기

include_once '../connect.php';

// ----------------------
// 1) 필수 파라미터 (GET 우선, 없으면 POST)
// ----------------------
$project_id     = 0;
$target_user_id = 0;
$reviewer_id    = 0;

if (isset($_GET['project_id'])) {
    $project_id = (int)$_GET['project_id'];
} elseif (isset($_POST['project_id'])) {
    $project_id = (int)$_POST['project_id'];
}

if (isset($_GET['target_user_id'])) {
    $target_user_id = (int)$_GET['target_user_id'];
} elseif (isset($_POST['target_user_id'])) {
    $target_user_id = (int)$_POST['target_user_id'];
}

// 데모용: 리뷰 작성자(로그인 유저 ID라고 가정)
if (isset($_GET['reviewer_id'])) {
    $reviewer_id = (int)$_GET['reviewer_id'];
} elseif (isset($_POST['reviewer_id'])) {
    $reviewer_id = (int)$_POST['reviewer_id'];
} else {
    $reviewer_id = 1; // 기본값
}

$isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');

// ❗ 잘못된 접근 체크는 "GET으로 처음 들어올 때만"
if (!$isPost && ($project_id <= 0 || $target_user_id <= 0)) {
    echo "<div style='padding:20px; font-family:Pretendard;'>잘못된 접근입니다. (project_id / target_user_id 필요)</div>";
    exit;
}

// ----------------------
// 2) 대상 팀원 정보 조회 (users + user_profiles)
// ----------------------
$sql = "
    SELECT 
        u.id,
        u.name,
        u.role,
        up.profile_image_url
    FROM users u
    LEFT JOIN user_profiles up ON up.user_id = u.id
    WHERE u.id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $target_user_id);
$stmt->execute();
$res  = $stmt->get_result();
$targetUser = $res->fetch_assoc();
$stmt->close();

if (!$targetUser) {
    echo "<div style='padding:20px; font-family:Pretendard;'>대상 팀원을 찾을 수 없습니다.</div>";
    exit;
}

$targetName = $targetUser['name'];

// ✅ 프로필 이미지 (없으면 기본 이미지)
$targetProfileImage = !empty($targetUser['profile_image_url'])
    ? $targetUser['profile_image_url']
    : '../img/default_profile.png';

// ----------------------
// 3) 폼 처리
// ----------------------
$errors  = [];
$success = false;

// POST된 값 (재렌더링 시 사용)
$postedRating   = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$postedComment  = isset($_POST['comment']) ? trim($_POST['comment']) : '';
$postedAnon     = isset($_POST['is_anonymous']) ? 1 : 0;
$postedKeywords = isset($_POST['keywords']) && is_array($_POST['keywords'])
                    ? $_POST['keywords']
                    : [];

if ($isPost) {

    // 1) 유효성 검사
    if ($postedRating < 1 || $postedRating > 5) {
        $errors[] = "협업 만족도를 선택해주세요.";
    }

    if ($postedComment === '') {
        $errors[] = "후기 한 줄을 입력해주세요.";
    }

    // 2) 통과하면 DB INSERT
    if (empty($errors)) {
        $keywordsStr = '';
        if (!empty($postedKeywords)) {
            // 쉼표로 연결해서 저장: "소통이 잘돼요,책임감 있어요"
            $keywordsStr = implode(',', $postedKeywords);
        }

        $sql = "
            INSERT INTO peer_reviews
                (project_id, reviewer_id, target_user_id, rating, keywords, comment, is_anonymous, created_at)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, NOW())
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "iiiissi",
            $project_id,
            $reviewer_id,
            $target_user_id,
            $postedRating,
            $keywordsStr,
            $postedComment,
            $postedAnon
        );

        if ($stmt->execute()) {
            $success = true;
            header("Location: 07_04_review.php?project_id=$project_id&target_user_id=$target_user_id&reviewer_id=$reviewer_id");
            exit;
        } else {
            $errors[] = "후기 저장 중 오류가 발생했습니다. (" . $stmt->error . ")";
        }
        $stmt->close();
    }
}

// 키워드 목록 (디자인에 있던 문구)
$keywordOptions = [
    "소통이 잘돼요",
    "책임감 있어요",
    "리드해줘요",
    "빠르게 대응해요",
    "아이디어가 좋아요",
];
?>

<div class="div">
    <div class="frame-parent">
        <div class="frame-wrapper">
            <div class="arrow-back-ios-new-parent">
                <!-- 뒤로가기 아이콘 -->
                <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

                <div class="frame-container">
                    <div class="wrapper">
                        <div class="div2">팀원 후기 작성하기</div>
                    </div>
                </div>

                <!-- 오른쪽 아이콘 (더미) -->
                <img class="arrow-back-ios-icon" alt="">
            </div>
        </div>

        <!-- 선택한 팀원 정보 -->
        <div class="frame-group">
            <div class="container">
                <div class="accept-terms-and">선택한 팀원에게 후기를 남겨주세요.</div>
            </div>
            <div class="frame-div" id="targetProfile" data-user="<?= (int)$target_user_id ?>">
                <!-- ✅ 프로필 이미지: DB 연동 -->
                <img
                    class="frame-child"
                    src="<?= htmlspecialchars($targetProfileImage, ENT_QUOTES, 'UTF-8') ?>"
                    alt="profile"
                >
                <div class="div2"><?= htmlspecialchars($targetName) ?></div>
            </div>
        </div>
    </div>

    <!-- 에러 / 성공 메시지 -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $err): ?>
                <div><?= htmlspecialchars($err) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            후기가 저장되었습니다 🎉
        </div>
    <?php endif; ?>

    <!-- 후기 작성 폼 -->
    <form method="post" class="review-form">
        <!-- project_id / target_user_id / reviewer_id 유지용 hidden -->
        <input type="hidden" name="project_id" value="<?= (int)$project_id ?>">
        <input type="hidden" name="target_user_id" value="<?= (int)$target_user_id ?>">
        <input type="hidden" name="reviewer_id" value="<?= (int)$reviewer_id ?>">

        <!-- 협업 만족도 + 익명 체크 -->
        <div class="frame-parent2">
            <div class="frame-parent3">
                <div class="frame-parent4">
                    <div class="container">
                        <div class="div5">협업 만족도</div>
                    </div>
                    <div class="star-parent" id="starContainer">
                        <?php
                        $currentRating = $postedRating > 0 ? $postedRating : 0;
                        for ($i = 1; $i <= 5; $i++):
                            $starSrc = ($i <= $currentRating) ? "../img/star_on.svg" : "../img/star_off.svg";
                        ?>
                            <img
                                class="frame-item"
                                src="<?= $starSrc ?>"
                                alt="star <?= $i ?>"
                                data-value="<?= $i ?>"
                            >
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="<?= $currentRating ?>">
                </div>

                <div class="checkbox">
                    <label class="checkbox-label">
                        <input
                            type="checkbox"
                            name="is_anonymous"
                            id="is_anonymous"
                            <?= $postedAnon ? 'checked' : '' ?>
                        >
                        <span class="checkbox-child"></span>
                        <span class="accept-terms-and">익명으로 남기기</span>
                    </label>
                </div>
            </div>

            <!-- 어떤 점이 좋았나요? (키워드) -->
            <div class="frame-parent5">
                <div class="container">
                    <div class="div5">어떤 점이 좋았나요?</div>
                </div>
                <div class="component-10-parent" id="keywordChips">
                    <?php foreach ($keywordOptions as $label):
                        $isSelected = in_array($label, $postedKeywords);
                    ?>
                        <div
                            class="keyword-chip <?= $isSelected ? 'component-10' : 'wrapper3' ?>"
                            data-value="<?= htmlspecialchars($label, ENT_QUOTES) ?>"
                        >
                            <div class="<?= $isSelected ? 'text' : 'div7' ?>">
                                <?= htmlspecialchars($label) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- 키워드 실제 전송용 hidden input들을 넣을 컨테이너 -->
                <div id="keywordHiddenInputs"></div>
            </div>
        </div>

        <!-- 후기 한 줄 남기기 -->
        <div class="frame-parent6">
            <div class="container">
                <div class="div5">후기 한 줄 남기기</div>
            </div>
            <div class="wrapper10">
                <textarea
                    name="comment"
                    class="comment-textarea"
                    placeholder="예: 프로젝트 전반을 책임감있게 이끌어줘서 고마웠어요!"
                ><?= htmlspecialchars($postedComment) ?></textarea>
            </div>
        </div>

        <!-- 저장 버튼 -->
        <div class="inner">
            <div class="buttons-wrapper">
                <button type="submit" class="buttons">
                    <div class="basic-icon-set"></div>
                    <b class="b">후기 저장하기</b>
                    <div class="basic-icon-set"></div>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
  var arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
  if (arrowBackIosNewIcon) {
    arrowBackIosNewIcon.addEventListener("click", function (e) {
      // 필요하면 이전 단계 이동
      window.history.back();
    });
  }

// --------------------------
// 1) 별점 클릭 처리
// --------------------------
(function() {
    const stars       = document.querySelectorAll(".frame-item");
    const ratingInput = document.getElementById("ratingInput");

    function renderStars(value) {
        stars.forEach(star => {
            const v = parseInt(star.dataset.value, 10);
            star.src = (v <= value) ? "../img/star_on.svg" : "../img/star_off.svg";
        });
    }
    var targetProfile = document.getElementById("targetProfile");
    if (targetProfile) {
        targetProfile.addEventListener("click", function () {
            var userId = this.dataset.user;
            if (!userId) return;

            // 09_user_profile.php로 이동 (네가 적어둔 대로 유지)
            window.location.href = "09_user_profile.php?user=" + userId;
        });
    }
    stars.forEach(star => {
        star.addEventListener("click", function () {
            const value = parseInt(this.dataset.value, 10);
            ratingInput.value = value;
            renderStars(value);
        });
    });

    const initialValue = parseInt(ratingInput.value || "0", 10);
    if (initialValue > 0) {
        renderStars(initialValue);
    }
})();

// --------------------------
// 2) 키워드 칩 토글 + hidden input 동기화
// --------------------------
(function() {
    const chipsContainer = document.getElementById("keywordChips");
    const hiddenArea     = document.getElementById("keywordHiddenInputs");

    if (!chipsContainer || !hiddenArea) return;

    function syncHiddenInputs() {
        hiddenArea.innerHTML = "";
        const selectedChips = chipsContainer.querySelectorAll(".keyword-chip.component-10");
        selectedChips.forEach(chip => {
            const value = chip.dataset.value || "";
            if (value) {
                const input = document.createElement("input");
                input.type  = "hidden";
                input.name  = "keywords[]";
                input.value = value;
                hiddenArea.appendChild(input);
            }
        });
    }

    chipsContainer.querySelectorAll(".keyword-chip").forEach(chip => {
        chip.addEventListener("click", function () {
            if (this.classList.contains("component-10")) {
                this.classList.remove("component-10");
                this.classList.add("wrapper3");
            } else {
                this.classList.remove("wrapper3");
                this.classList.add("component-10");
            }
            syncHiddenInputs();
        });
    });

    // 처음 로드 시에도 동기화 (POST 후 재렌더링 대비)
    syncHiddenInputs();
})();

</script>
