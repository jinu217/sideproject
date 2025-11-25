<?php
// /tishoo/page/view/03_view.php
?>
<div class="div">
    <!-- 상단 타이틀 영역 -->
    <div class="inner">
        <div class="arrow-back-ios-new-parent">
            <img class="arrow-back-ios-new-icon" alt="">
            <div class="frame-wrapper">
                <div class="wrapper">
                    <div class="div2">프로젝트 상세페이지</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 상단 히어로 카드 (이미지 영역) -->
    <div class="card">
        <div class="card-child"></div>
    </div>

    <!-- 프로젝트 기본 정보 영역 -->
    <div class="frame-parent">
        <div class="frame-container">
            <div class="chips-parent">
                <div class="chips">
                    <div class="text">모집중</div>
                </div>
                <div class="chips2">
                    <div class="text">헬스케어</div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="div3">
                치매 어르신들을 위한 위치공유 및 위치추적 어플리케이션
            </div>
        </div>

        <div class="frame">
            <div class="div4">
                보호자와 가족이 안심할 수 있는 위치 공유 서비스를 함께 만들 팀원을 찾고 있어요.
            </div>
        </div>
    </div>

    <!-- 작성자 정보 / 열정 온도 -->
    <div class="child">
        <div class="parent">
            <div class="div5">열정 온도</div>

            <div class="group-wrapper">
                <div class="group">
                    <div class="div6">36℃</div>
                    <img class="layer-1-icon" alt="">
                </div>
            </div>

            <div class="frame-group">
                <img class="frame-child" alt="">
                <div class="owner-symbol-fill-parent">
                    <img class="owner-symbol-fill" alt="">
                    <b class="b">김진우</b>
                    <img class="frame-item" alt="">
                </div>
            </div>

            <div class="div7">1시간 전 접속</div>
        </div>
    </div>

    <!-- 모집 조건 / 도메인 / 방식 / 사용 툴 / 모집 분야 -->
    <div class="frame-div">
        <div class="frame-parent2">
            <div class="parent2">
                <div class="div8">모집 인원</div>
                <div class="div9">5명</div>
                <div class="div10">연령제한 없음</div>
            </div>

            <div class="divider"></div>

            <div class="parent2">
                <div class="div8">예상 기간</div>
                <div class="div12">4~6개월</div>
                <div class="div10">연령제한 없음</div>
            </div>

            <div class="divider"></div>

            <div class="parent2">
                <div class="div14">시작 예정일</div>
                <div class="div9">11.12</div>
                <div class="div10">2025년 기준</div>
            </div>
        </div>

        <div class="divider-parent">
            <div class="divider3"></div>

            <div class="parent5">
                <div class="div17">도메인</div>
                <div class="wrapper2">
                    <div class="div18">헬스케어</div>
                </div>
            </div>

            <div class="parent5">
                <div class="div17">진행 방식</div>
                <div class="parent7">
                    <div class="div18">온라인 위주 비동기 협업</div>
                    <div class="div21">필요시 오프라인 미팅 조율</div>
                </div>
            </div>

            <div class="parent5">
                <div class="div17">연락 방법</div>
                <div class="parent7">
                    <div class="div18">오픈톡 링크</div>
                    <div class="div21">매칭 후 개별 안내 예정</div>
                </div>
            </div>

            <div class="parent5">
                <div class="div17">사용 툴</div>
                <img class="frame-inner" alt="">
            </div>

            <div class="divider4"></div>

            <div class="parent11">
                <div class="div18">모집 분야</div>
                <div class="frame-parent3">
                    <div class="hacker-parent">
                        <div class="hacker">Hacker</div>
                        <div class="div27">2 / 3</div>
                    </div>
                    <div class="hacker-parent">
                        <div class="hacker">Hipster</div>
                        <div class="div28">2 / 3</div>
                    </div>
                    <div class="hacker-parent">
                        <div class="hacker">Hustler</div>
                        <div class="div28">2 / 3</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AD 영역 -->
    <div class="div30">
        <div class="div31">
            <div class="ad-wrapper">
                <div class="ad">AD</div>
            </div>
        </div>
    </div>

    <!-- ======================
         탭 네비게이션
         ====================== -->
    <div class="navi">
        <div class="component-1 navi-tab" data-tab="detail">
            <div class="div2">상세정보</div>
        </div>

        <div class="component-5 navi-tab" data-tab="team">
            <div class="text4">팀정보</div>
        </div>

        <div class="component-5 navi-tab" data-tab="progress">
            <div class="text4">진행도</div>
        </div>

        <div class="component-5 navi-tab" data-tab="qna">
            <div class="text4">QnA</div>
        </div>
    </div>

    <!-- ======================
         탭별 내용 영역
         ====================== -->

    <!-- 상세정보 탭 -->
    <div id="tab-detail" style="width:100%;">
        <?php include __DIR__ . '/03_01_view_tab_detail.php'; ?>
    </div>

    <!-- 팀정보 탭 -->
    <div id="tab-team" style="display:none; width:100%;">
        <?php include __DIR__ . '/03_02_view_tab_team.php'; ?>
    </div>

    <!-- 진행도 탭 -->
    <div id="tab-progress" style="display:none; width:100%;">
        <?php include __DIR__ . '/03_03_view_tab_progress.php'; ?>
    </div>

    <!-- QnA 탭 -->
    <div id="tab-qna" style="display:none; width:100%;">
        <?php include __DIR__ . '/03_04_view_tab_qna.php'; ?>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs     = document.querySelectorAll('.navi-tab');
    const detail   = document.getElementById('tab-detail');
    const team     = document.getElementById('tab-team');
    const progress = document.getElementById('tab-progress');
    const qna      = document.getElementById('tab-qna');

    function showTab(name) {
        // 탭 스타일 토글 (.active-tab 붙이기)
        tabs.forEach(t => {
            if (t.dataset.tab === name) {
                t.classList.add('active-tab');
            } else {
                t.classList.remove('active-tab');
            }
        });

        // 내용 영역 토글
        if (detail)   detail.style.display   = (name === 'detail')   ? 'block' : 'none';
        if (team)     team.style.display     = (name === 'team')     ? 'block' : 'none';
        if (progress) progress.style.display = (name === 'progress') ? 'block' : 'none';
        if (qna)      qna.style.display      = (name === 'qna')      ? 'block' : 'none';
    }

    tabs.forEach(t => {
        t.addEventListener('click', function () {
            const target = this.dataset.tab;
            if (!target) return;
            showTab(target);
        });
    });

    // 초기: 상세정보 탭 활성화
    showTab('detail');
});
</script>
