<div class="div">
    <div class="div2">
        <img class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">
        
        <div class="parent">
            <div class="div3">프로젝트 생성</div>
            <div class="div4">2 / 5</div>
        </div>
    </div>
    <div class="div5">
        <div class="group">
            <div class="div6">프로젝트의 현재 상태는 무엇인가요?</div>

            <div class="frame-parent">
                <!-- 1번 카드 -->
                <div class="container option-btn" data-option="1">
                    <div class="mvp">기획 단계</div>
                    <div class="div8">아이디어만 있는 상태</div>
                </div>

                <!-- 2번 카드 -->
                <div class="frame-div option-btn" id="frameContainer1" data-option="2">
                    <div class="mvp">아이디어 구체화 중</div>
                    <div class="div8">연구와 테스트를 통해 핵심 기능 식별</div>
                </div>

                <!-- 3번 카드 -->
                <div class="container option-btn" data-option="3">
                    <div class="mvp">MVP 개발 중</div>
                    <div class="div8">디자인 및 개발 중</div>
                </div>

                <!-- 4번 카드 -->
                <div class="container option-btn" data-option="4">
                    <div class="mvp">새 버전 준비 중</div>
                    <div class="div8">이전에 완료된 프로젝트를 새 버전으로 발전시키기</div>
                </div>
            </div>
        </div>
    </div>
    <div class="child"></div>
    <div class="div14">
        <div class="div15" id="nextBtn">
            <div class="wrapper">
                <div class="div16">다음</div>
            </div>
        </div>
    </div>
</div>

<script>
    // 뒤로가기 아이콘 (필요하면 1단계로 이동하도록 변경 가능)
    var arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
    if (arrowBackIosNewIcon) {
        arrowBackIosNewIcon.addEventListener("click", function (e) {
            // 예: 이전 단계로 돌아가기
            // window.location.href = "04_01_new_project.php";
            window.history.back();
        });
    }

    const optionButtons = document.querySelectorAll(".option-btn");
    const nextBtn = document.getElementById("nextBtn");

    // 상태 카드 선택 로직
    optionButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // 1) 모든 카드에서 선택 해제
            optionButtons.forEach(b => b.classList.remove("option-selected"));

            // 2) 클릭한 카드만 선택
            btn.classList.add("option-selected");

            // 3) '다음' 버튼 활성화
            if (nextBtn) {
                nextBtn.classList.add("active");
            }
        });
    });

    // '다음' 버튼 클릭 시 다음 단계로 이동
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            if (!nextBtn.classList.contains("active")) return;

            // ✅ 3단계 페이지로 이동 (파일명 다르면 여기만 바꿔줘)
            window.location.href = "04_03_new_project.php";
        });
    }
</script>
