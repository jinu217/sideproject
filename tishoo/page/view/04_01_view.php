<!-- 04_01_new_project.php 내용 예시: 프로젝트 목표 선택 화면 -->

<div class="div">
    <!-- 상단 헤더 영역 -->
    <div class="div2">
        <img class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

        <div class="parent">
            <div class="div3">프로젝트 생성</div>
            <div class="div4">1 / 5</div>
        </div>
    </div>

    <!-- 질문 + 4개 옵션 -->
    <div class="div5">
        <div class="group">
            <div class="div6">프로젝트의 목표는 무엇인가요?</div>

            <!-- 1번 버튼 -->
            <div class="mvp-wrapper option-btn" data-option="1">
                <div class="mvp">MVP 개발 / 출시</div>
            </div>

            <!-- 2번 버튼 -->
            <div class="wrapper option-btn" data-option="2">
                <div class="mvp">스타트업 / 비즈니스</div>
            </div>

            <!-- 3번 버튼 -->
            <div class="container option-btn" data-option="3">
                <div class="mvp">소셜 네트워킹</div>
            </div>

            <!-- 4번 버튼 -->
            <div class="frame option-btn" id="frameContainer3" data-option="4">
                <div class="mvp">협업 경험</div>
            </div>
        </div>
    </div>

    <!-- (필요시 여백 / 이미지 자리) -->
    <div class="child"></div>

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
    // 뒤로가기 아이콘 클릭 (필요한 동작 넣어줘)
    var arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
    if (arrowBackIosNewIcon) {
        arrowBackIosNewIcon.addEventListener("click", function (e) {
            // 예시: 이전 페이지
            // window.history.back();
        });
    }

    // 4개의 옵션 버튼
    const optionButtons = document.querySelectorAll(".option-btn");
    const nextBtn = document.getElementById("nextBtn");

    optionButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // 1) 모든 버튼의 선택 상태 제거
            optionButtons.forEach(b => b.classList.remove("option-selected"));

            // 2) 지금 클릭한 버튼만 선택 상태
            btn.classList.add("option-selected");

            // 3) '다음' 버튼 활성화
            if (nextBtn) {
                nextBtn.classList.add("active");
            }
        });
    });

    // '다음' 버튼 클릭 시 동작 (다음 단계로 이동 등)
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            if (!nextBtn.classList.contains("active")) return;
            window.location.href = "04_02_new_project.php";
        });
    }
</script>
