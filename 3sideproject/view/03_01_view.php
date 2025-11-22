<!-- 03_view.php : 프로젝트 생성 - 목표 선택 -->

<div style="width: 100%; background: white; flex-direction: column; justify-content: flex-start; align-items: flex-end; display: inline-flex">
    <!-- 상단 헤더 -->
    <div style="width: 375px; height: 68px; padding-top: 10px; padding-bottom: 10px; outline: 1px var(--Line-Normal-Neutral, rgba(112, 115, 124, 0.16)) solid; outline-offset: -1px; justify-content: flex-start; align-items: center; gap: 41px; display: inline-flex">
        <img src="./img/arrow_back_ios_new.svg" style="padding-left: 16px; width: 24px; height: 24px; cursor: pointer;" onclick="history.back()">
        <div style="width: 213.06px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 6px; display: inline-flex">
            <div style="align-self: stretch; height: 27px; text-align: center; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 18px; font-family: Pretendard; font-weight: 600; line-height: 25.20px; word-wrap: break-word">프로젝트 생성</div>
            <div style="align-self: stretch; height: 14.22px; text-align: center; justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-50, #737373); font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">1 / 5</div>
        </div>
    </div>

    <!-- 질문 + 목표 선택 4개 -->
    <div style="align-self: stretch; height: 387px; padding-top: 40px; padding-bottom: 40px; background: white; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: center; gap: 50px; display: flex">
        <div style="width: 324px; height: 219px; position: relative">
            <div style="width: 324px; height: 27px; left: 0px; top: -19px; position: absolute; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 16px; font-family: Pretendard; font-weight: 600; line-height: 24px; word-wrap: break-word">
                프로젝트의 목표는 무엇인가요?
            </div>

            <!-- 1번 -->
            <div class="goal-option" data-value="MVP 개발 / 출시"
                 style="width: 324px; height: 40px; left: 0px; top: 35px; position: absolute; background: #D9D9D9; border-radius: 12px; justify-content: center; align-items: center; display: inline-flex; cursor:pointer;">
                <div class="goal-label" style="color:#474747; font-size:16px; font-weight:600;">MVP 개발 / 출시</div>
            </div>

            <!-- 2번 -->
            <div class="goal-option" data-value="스타트업 / 비즈니스"
                 style="width: 324px; height: 40px; left: 0px; top: 83px; position: absolute; background: #D9D9D9; border-radius: 12px; justify-content: center; align-items: center; display: inline-flex; cursor:pointer;">
                <div class="goal-label" style="color:#474747; font-size:16px; font-weight:600;">스타트업 / 비즈니스</div>
            </div>

            <!-- 3번 -->
            <div class="goal-option" data-value="소셜 네트워킹"
                 style="width: 324px; height: 40px; left: 0px; top: 131px; position: absolute; background: #D9D9D9; border-radius: 12px; justify-content: center; align-items: center; display: inline-flex; cursor:pointer;">
                <div class="goal-label" style="color:#474747; font-size:16px; font-weight:600;">소셜 네트워킹</div>
            </div>

            <!-- 4번 -->
            <div class="goal-option" data-value="협업 경험"
                 style="width: 324px; height: 40px; left: 0px; top: 179px; position: absolute; background: #D9D9D9; border-radius: 12px; justify-content: center; align-items: center; display: inline-flex; cursor:pointer;">
                <div class="goal-label" style="color:#474747; font-size:16px; font-weight:600;">협업 경험</div>
            </div>
        </div>
    </div>

    <div style="width: 242.40px; height: 100px; background: white"></div>

    <!-- 🔵 다음 버튼 (기본: 비활성화 회색) -->
    <div style="width: 323px; padding-left: 26px; padding-right: 26px; padding-top: 29px; padding-bottom: 29px; background: white; display:flex;">
        <div id="nextBtn"
             style="align-self: stretch; width:100%; height: 60px; position: relative;
                    background: var(--Blue-80, #9EC5FF); border-radius: 40px; transition:0.2s;">
            <div style="width: 31px; height: 44px; left: 146.5px; top: 8px; position: absolute; display:flex; justify-content:center; align-items:center;">
                <div style="color:white; font-size:16px; font-weight:600;">다음</div>
            </div>
        </div>
    </div>
</div>

<!-- 선택 상태 처리 -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const options = document.querySelectorAll('.goal-option');
    const nextBtn = document.getElementById('nextBtn');

    let selected = false;

    options.forEach(option => {
        option.addEventListener('click', function () {
            // 초기화
            options.forEach(o => {
                o.style.background = '#D9D9D9';
                o.querySelector('.goal-label').style.color = '#474747';
            });

            // 클릭된 것만 활성화
            this.style.background = 'var(--tishoo-Cyan, #1E78FF)';
            this.querySelector('.goal-label').style.color = 'white';

            // 다음 버튼 활성화
            nextBtn.style.background = 'var(--tishoo-Cyan, #1E78FF)';
            nextBtn.style.cursor = 'pointer';
            nextBtn.dataset.active = "1";

            selected = true;
        });
    });

    // 클릭 안되면 이동 못하게 막을 수도 있음
    nextBtn.addEventListener('click', function () {
        if (nextBtn.dataset.active !== "1") {
            return; // 선택되지 않은 경우 클릭 무시
        }

        window.location.href = "03_02_new_project.php";
        // 이동 원하면 여기에 window.location = "다음페이지.php";
    });
});
</script>
