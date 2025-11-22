<!-- 03_01_view.php : 프로젝트 생성 - 현재 상태 선택 -->

<div style="width: 100%; background: white; flex-direction: column; justify-content: flex-start; align-items: flex-end; display: inline-flex">

    <!-- 헤더 -->
    <div style="width: 375px; height: 68px; padding-top: 10px; padding-bottom: 10px; outline: 1px var(--Line-Normal-Neutral, rgba(112, 115, 124, 0.16)) solid; outline-offset: -1px; justify-content: flex-start; align-items: center; gap: 41px; display: inline-flex">
        <img src="./img/arrow_back_ios_new.svg" style="padding-left: 16px; width: 24px; height: 24px; cursor: pointer;" onclick="history.back()">
        <div style="width: 213.06px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 6px; display: inline-flex">
            <div style="align-self: stretch; height: 27px; text-align: center; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 18px; font-family: Pretendard; font-weight: 600; line-height: 25.20px;">
                프로젝트 생성
            </div>
            <div style="align-self: stretch; height: 14.22px; text-align: center; justify-content: center; display: flex; flex-direction: column; color: var(--Neutral-50, #737373); font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px;">
                2 / 5
            </div>
        </div>
    </div>

    <!-- 질문 / 선택 영역 -->
    <div style="align-self: stretch; padding-top: 20px; padding-bottom: 40px; background: white; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: center; gap: 50px; display: flex">
        <div style="width: 324px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 22px; display: flex">

            <div style="align-self: stretch; height: 27px; justify-content: center; display: flex; flex-direction: column; color: black; font-size: 16px; font-family: Pretendard; font-weight: 600;">
                프로젝트의 현재 상태는 무엇인가요?
            </div>

            <div style="align-self: stretch; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 8px; display: flex">

                <!-- 1 -->
                <div class="goal-option" data-value="기획 단계"
                    style="align-self: stretch; height: 54px; padding-top: 8px; padding-left: 18px; padding-right: 18px; background: #D9D9D9; border-radius: 12px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex; cursor:pointer;">
                    <div class="goal-label" style="color: #474747; font-size: 16px; font-weight: 600;">기획 단계</div>
                    <div class="goal-desc" style="color: #737373; font-size: 13px; font-weight: 600;">아이디어만 있는 상태</div>
                </div>

                <!-- 2 -->
                <div class="goal-option" data-value="아이디어 구체화 중"
                    style="align-self: stretch; height: 54px; padding-top: 8px; padding-left: 18px; padding-right: 18px; background: #D9D9D9; border-radius: 12px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex; cursor:pointer;">
                    <div class="goal-label" style="color: #474747; font-size: 16px; font-weight: 600;">아이디어 구체화 중</div>
                    <div class="goal-desc" style="color: #737373; font-size: 13px; font-weight: 600;">연구와 테스트를 통해 핵심 기능 식별</div>
                </div>

                <!-- 3 -->
                <div class="goal-option" data-value="MVP 개발 중"
                    style="align-self: stretch; height: 54px; padding-top: 8px; padding-left: 18px; padding-right: 18px; background: #D9D9D9; border-radius: 12px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex; cursor:pointer;">
                    <div class="goal-label" style="color: #474747; font-size: 16px; font-weight: 600;">MVP 개발 중</div>
                    <div class="goal-desc" style="color: #737373; font-size: 13px; font-weight: 600;">디자인 및 개발 중</div>
                </div>

                <!-- 4 -->
                <div class="goal-option" data-value="새 버전 준비 중"
                    style="align-self: stretch; height: 54px; padding-top: 8px; padding-left: 18px; padding-right: 18px; background: #D9D9D9; border-radius: 12px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: flex; cursor:pointer;">
                    <div class="goal-label" style="color: #474747; font-size: 16px; font-weight: 600;">새 버전 준비 중</div>
                    <div class="goal-desc" style="color: #737373; font-size: 13px; font-weight: 600;">이전에 완료된 프로젝트를 새 버전으로 발전시키기</div>
                </div>

            </div>
        </div>
    </div>

    <!-- 여백 -->
    <div style="width: 242.40px; height: 185.8px; background: white"></div>

    <!-- 다음 버튼 -->
    <div style="width: 323px; padding-left: 26px; padding-right: 26px; padding-top: 29px; padding-bottom: 29px; background: white; display:flex;">
        <div id="nextBtn"
             style="width:100%; height: 60px; position: relative;
                    background: var(--Blue-80, #9EC5FF); border-radius: 40px; transition:0.2s;">
            <div style="width: 31px; height: 44px; left: 50%; top: 8px; transform: translateX(-50%); position: absolute; display:flex; justify-content:center; align-items:center;">
                <div style="color:white; font-size:16px; font-weight:600;">다음</div>
            </div>
        </div>
    </div>
</div>

<!-- 선택 / 버튼 활성화 / 다음 페이지 이동 -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const options = document.querySelectorAll('.goal-option');
    const nextBtn = document.getElementById('nextBtn');

    options.forEach(option => {
        option.addEventListener('click', function () {

            // 모든 박스 초기화
            options.forEach(o => {
                o.style.background = '#D9D9D9';
                o.querySelector('.goal-label').style.color = '#474747';

                const desc = o.querySelector('.goal-desc');
                if (desc) desc.style.color = '#737373';
            });

            // 클릭된 박스만 활성화
            this.style.background = 'var(--tishoo-Cyan, #1E78FF)';
            this.querySelector('.goal-label').style.color = 'white';

            const desc = this.querySelector('.goal-desc');
            if (desc) desc.style.color = 'white';

            // 다음 버튼 활성화
            nextBtn.style.background = 'var(--tishoo-Cyan, #1E78FF)';
            nextBtn.style.cursor = 'pointer';
            nextBtn.dataset.active = "1";
        });
    });

    // 다음 버튼 클릭 시 이동
    nextBtn.addEventListener('click', function () {
        if (nextBtn.dataset.active !== "1") {return;}
        window.location.href = "03_03_new_project.php";
    });

});
</script>
