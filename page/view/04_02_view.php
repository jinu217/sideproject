<!-- 04_02_new_project.php -->

<div class="page-wrap">
    <!-- 상단 헤더 -->
    <div class="div2">
        <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

        <div class="parent">
            <div class="div3">프로젝트 생성</div>
            <div class="div4">2 / 5</div>
        </div>
    </div>

    <!-- 본문 내용 -->
    <div class="content">
        <div class="question">프로젝트의 현재 상태는 무엇인가요?</div>

        <div class="card-list">
            <!-- 1번 카드 -->
            <div class="card option-btn" data-option="1">
                <div class="card-title">기획 단계</div>
                <div class="card-desc">아이디어만 있는 상태</div>
            </div>

            <!-- 2번 카드 -->
            <div class="card option-btn" data-option="2">
                <div class="card-title">아이디어 구체화 중</div>
                <div class="card-desc">연구와 테스트를 통해 핵심 기능 식별</div>
            </div>

            <!-- 3번 카드 -->
            <div class="card option-btn" data-option="3">
                <div class="card-title">MVP 개발 중</div>
                <div class="card-desc">디자인 및 개발 중</div>
            </div>

            <!-- 4번 카드 -->
            <div class="card option-btn" data-option="4">
                <div class="card-title">새 버전 준비 중</div>
                <div class="card-desc">이전에 완료된 프로젝트를 새 버전으로 발전시키기</div>
            </div>
        </div>
    </div>

    <!-- 하단 고정 버튼 -->
    <!-- 하단 '다음' 버튼 -->
    <div class="div10">
        <div class="div11" id="nextBtn">
            <div class="frame-div">
                <div class="mvp">다음</div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const optionButtons = document.querySelectorAll(".option-btn");
    const nextBtn = document.getElementById("nextBtn");
    const backIcon = document.getElementById("arrowBackIosNewIcon");

    // 옵션 카드 선택 로직
    optionButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            optionButtons.forEach(b => b.classList.remove("option-selected"));
            btn.classList.add("option-selected");
            if (nextBtn) {
                nextBtn.classList.add("active");
            }
        });
    });

    // 뒤로가기 (이전 단계로)
    if (backIcon) {
        backIcon.addEventListener("click", () => {
            // 필요하면 히스토리 말고 04_01로 고정 이동도 가능
            // window.location.href = "04_01_new_project.php";
            window.history.back();
        });
    }

    // 다음 버튼 클릭 시 3단계로 이동
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            if (!nextBtn.classList.contains("active")) return;
            window.location.href = "04_03_new_project.php";
        });
    }
});
</script>
