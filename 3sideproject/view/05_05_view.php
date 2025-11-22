<?php
// ===============================
// 05_05_view.php : 팀원 후기 작성
// ===============================
include_once 'connect.php';

// GET 파라미터 (어느 프로젝트, 누구에게 쓰는 후기인지)
$project_id     = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 1;
$target_user_id = isset($_GET['target_user_id']) ? (int)$_GET['target_user_id'] : 0;

// 시연용 현재 로그인 유저 (유저1)
$current_user_id = 2;

// 대상 유저 정보 가져오기
$target_user = null;
if ($target_user_id > 0) {
    $sql = "SELECT id, name FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $target_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $target_user = $result->fetch_assoc();
    $stmt->close();
}

if (!$target_user) {
    echo "<div style='padding:20px; font-family:Pretendard;'>잘못된 접근입니다. (대상 유저가 없습니다)</div>";
    exit;
}

$error = "";
$message = "";

// POST 처리 (후기 저장)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating       = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment      = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $is_anonymous = isset($_POST['is_anonymous']) && $_POST['is_anonymous'] == '1' ? 1 : 0;

    if ($rating < 1 || $rating > 5) {
        $error = "별점을 선택해주세요.";
    } elseif ($comment === '') {
        $error = "후기 내용을 입력해주세요.";
    } elseif ($current_user_id === $target_user_id) {
        // 필요 없으면 이 조건/메시지 삭제해도 됨
        $error = "자기 자신에게는 후기를 남길 수 없습니다.";
    } else {
        $sql = "
            INSERT INTO peer_reviews
            (project_id, reviewer_id, target_user_id, rating, comment, is_anonymous)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "iiiisi",
            $project_id,
            $current_user_id,
            $target_user_id,
            $rating,
            $comment,
            $is_anonymous
        );

        if ($stmt->execute()) {
            // 성공 시 해당 유저 프로필(06)로 이동
            header("Location: 06_user_profile.php?user_id=" . $target_user_id);
            exit;
        } else {
            // UNIQUE 제약 등 에러
            if ($conn->errno == 1062) {
                $error = "이미 이 팀원에게 후기를 작성했습니다.";
            } else {
                $error = "저장 중 오류가 발생했습니다: " . $conn->error;
            }
        }
        $stmt->close();
    }
}
?>

<!-- 여기부터는 기존 디자인 그대로 + form/hidden만 추가 -->

<form id="reviewForm" method="post" style="width:100%;">
    <!-- hidden 필드들 -->
    <input type="hidden" name="rating" id="ratingInput" value="0">
    <input type="hidden" name="is_anonymous" id="isAnonymousInput" value="0">

    <div style="width: 100%; padding-top: 40px; padding-bottom: 40px; background: white; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 40px; display: inline-flex">
        <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 50px; display: flex">
            <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: center; gap: 20px; display: flex">
                <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                    <img src="./img/arrow_back_ios_new.svg" style="width: 20px; height: 20px; cursor: pointer;"onclick="history.back()">
                    <div style="width: 8.71px; height: 15.80px;"></div>
                    <div style="justify-content: flex-start; align-items: flex-start; gap: 1.99px; display: flex">
                        <div style="padding-left: 1.99px; padding-right: 1.99px; justify-content: center; align-items: center; gap: 5.98px; display: flex">
                            <div style="text-align: right; color: #333333; font-size: 20px; font-family: Pretendard; font-weight: 600; line-height: 28px; word-wrap: break-word">팀원 후기 작성하기</div>
                        </div>
                    </div>
                    <div style="width: 20px; height: 20px;"></div>
                    <div style="width: 8.71px; height: 15.80px;"></div>
                </div>

                <!-- 에러 메시지 (간단히만) -->
                <?php if ($error): ?>
                    <div style="align-self: stretch; margin-top:10px; padding:10px 12px; border-radius:12px; background:#FEF2F2; color:#B91C1C; font-size:13px; font-family:Pretendard;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: center; gap: 24px; display: flex">
                <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                    <div style="text-align: right; color: #333333; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">선택한 팀원에게 후기를 남겨주세요.</div>
                </div>
                <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 14px; display: flex">
                    <img style="width: 99px; height: 99px; position: relative; border-radius: 99px" src="https://placehold.co/99x99" />
                    <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 17px; font-family: Pretendard; font-weight: 600; line-height: 23.80px; word-wrap: break-word">
                        <?= htmlspecialchars($target_user['name']) ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 30px; display: flex">
            <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 14px; display: flex">
                <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <div style="text-align: right; color: #333333; font-size: 16px; font-family: Pretendard; font-weight: 600; line-height: 24px; word-wrap: break-word">협업 만족도</div>
                    </div>
                    <div id="ratingStars" style="display:flex; justify-content:flex-start; align-items:center; gap:4px;">
                        <img src="img/star_off.svg" data-value="1" style="width:20px; height:20px; cursor:pointer;">
                        <img src="img/star_off.svg" data-value="2" style="width:20px; height:20px; cursor:pointer;">
                        <img src="img/star_off.svg" data-value="3" style="width:20px; height:20px; cursor:pointer;">
                        <img src="img/star_off.svg" data-value="4" style="width:20px; height:20px; cursor:pointer;">
                        <img src="img/star_off.svg" data-value="5" style="width:20px; height:20px; cursor:pointer;">
                    </div>
                </div>
                <div data-state="default" style="align-self: stretch; justify-content: flex-end; align-items: center; gap: 8px; display: inline-flex">
                    <div id="anonymousCheck"
                        style="width: 14px; height: 14px; background: white; border-radius: 2px; border: 1px #E5E7EB solid; cursor:pointer;">
                    </div>
                    <div style="color: var(--Neutral-Color-7, #333333); font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px;">
                        익명으로 남기기
                    </div>
                </div>
            </div>

            <!-- 어떤 점이 좋았나요? -->
            <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 20px; display: flex">
                <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                    <div style="text-align: right; color: #333333; font-size: 16px; font-family: Pretendard; font-weight: 600; line-height: 24px; word-wrap: break-word">
                        어떤 점이 좋았나요?
                    </div>
                </div>

                <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex; flex-wrap: wrap; align-content: flex-start">

                    <!-- 아래 태그들은 UI용. DB에는 지금은 별도로 안 넣고, 필요하면 comment에 추가하는 식으로 나중에 확장 가능 -->

                    <!-- 소통이 잘돼요 (1) -->
                    <div class="review-tag" data-value="소통이 잘돼요"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            소통이 잘돼요
                        </div>
                    </div>

                    <!-- 소통이 잘돼요 (2) -->
                    <div class="review-tag" data-value="소통이 잘돼요2"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            소통이 잘돼요
                        </div>
                    </div>

                    <!-- 책임감있어요 (1) -->
                    <div class="review-tag" data-value="책임감있어요"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            책임감있어요
                        </div>
                    </div>

                    <!-- 책임감있어요 (2) -->
                    <div class="review-tag" data-value="책임감있어요2"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            책임감있어요
                        </div>
                    </div>

                    <!-- 리드해줘요 -->
                    <div class="review-tag" data-value="리드해줘요"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            리드해줘요
                        </div>
                    </div>

                    <!-- 빠르게 대응해요 -->
                    <div class="review-tag" data-value="빠르게 대응해요"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            빠르게 대응해요
                        </div>
                    </div>

                    <!-- 아이디어가 좋아요 -->
                    <div class="review-tag" data-value="아이디어가 좋아요"
                        style="height: 20px; padding-left: 14px; padding-right: 14px; padding-top: 10px; padding-bottom: 10px;
                                background: #F1F5F9; border-radius: 99px; outline: 1px #E2E8F0 solid; outline-offset: -1px;
                                justify-content: center; align-items: center; gap: 10px; display: flex; cursor:pointer;">
                        <div style="text-align: right; color: black; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">
                            아이디어가 좋아요
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 후기 한 줄 남기기 -->
        <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
            <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                <div style="text-align: right; color: #333333; font-size: 16px; font-family: Pretendard; font-weight: 600; line-height: 24px; word-wrap: break-word">
                    후기 한 줄 남기기
                </div>
            </div>
            <div style="align-self: stretch; height: 118px; padding: 14px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                <textarea
                    id="reviewComment"
                    name="comment"
                    placeholder="예: 프로젝트 전반을 책임감있게 이끌어줘서 고마웠어요!"
                    style="
                        width: 100%;
                        height: 100%;
                        border: none;
                        background: transparent;
                        resize: none;
                        outline: none;
                        color: #0F172A;
                        font-size: 13px;
                        font-family: Pretendard, -apple-system, BlinkMacSystemFont, sans-serif;
                        line-height: 19.5px;
                    "
                ></textarea>
            </div>
        </div>

        <!-- 저장 버튼 -->
        <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
            <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
                <div 
                    id="saveReviewBtn"
                    style="cursor:pointer; align-self: stretch; padding: 16px; background: var(--tishoo-Cyan, #1E78FF); overflow: hidden; border-radius: 99px; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="color: var(--Static-White, white); font-size: 14px; font-family: Spoqa Han Sans Neo; font-weight: 700; line-height: 20px; word-wrap: break-word">
                        후기 저장하기
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", () => {

    /* ⭐ 별점 */
    const stars = document.querySelectorAll("#ratingStars img");
    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener("click", function () {
            currentRating = this.dataset.value;
            stars.forEach(s => s.src = "img/star_off.svg");
            for (let i = 0; i < currentRating; i++) stars[i].src = "img/star_on.svg";
        });
    });


    /* 🔳 익명 체크박스 */
    const anonymousBox = document.getElementById("anonymousCheck");
    anonymousBox.dataset.checked = "0";

    anonymousBox.addEventListener("click", function () {
        if (this.dataset.checked === "1") {
            this.dataset.checked = "0";
            this.style.background = "white";
            this.style.border = "1px #E5E7EB solid";
        } else {
            this.dataset.checked = "1";
            this.style.background = "var(--tishoo-Cyan, #1E78FF)";
            this.style.border = "1px white solid";
        }
    });


    /* 💬 태그 선택 (UI만, DB 저장은 아직 X) */
    const tags = document.querySelectorAll(".review-tag");

    tags.forEach(tag => {
        tag.addEventListener("click", function () {
            const selected = this.dataset.selected === "1";
            const label = this.querySelector("div");

            if (selected) {
                this.dataset.selected = "0";
                this.style.background = "#F1F5F9";
                this.style.outline = "1px #E2E8F0 solid";
                label.style.color = "black";
                label.style.fontWeight = "400";
            } else {
                this.dataset.selected = "1";
                this.style.background = "var(--tishoo-Cyan, #1E78FF)";
                this.style.outline = "1px var(--tishoo-Cyan, #1E78FF) solid";
                label.style.color = "white";
                label.style.fontWeight = "500";
            }
        });
    });

    /* ✅ 후기 저장하기 버튼 → form submit */
    const saveBtn = document.getElementById("saveReviewBtn");
    const ratingInput = document.getElementById("ratingInput");
    const anonInput   = document.getElementById("isAnonymousInput");
    const form        = document.getElementById("reviewForm");

    saveBtn.addEventListener("click", function () {
        if (currentRating <= 0) {
            alert("협업 만족도(별점)를 선택해주세요.");
            return;
        }

        const comment = document.getElementById("reviewComment").value.trim();
        if (!comment) {
            alert("후기 한 줄을 입력해주세요.");
            return;
        }

        ratingInput.value = currentRating;
        anonInput.value   = (anonymousBox.dataset.checked === "1") ? "1" : "0";

        form.submit();
    });

});
</script>
