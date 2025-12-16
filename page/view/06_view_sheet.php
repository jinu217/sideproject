<?php
// 06_view_sheet.php : 팀 찾기 필터 바텀시트 (관심 도메인 / 목적 / 사용하는 툴)

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'domain';
$allowedTabs = ['domain', 'purpose', 'tools'];
if (!in_array($tab, $allowedTabs, true)) {
    $tab = 'domain';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">

    <link rel=" esheet" href="https://fonts.googleapis.com/css2?family=[object Object]&display=swap" />

    <title>팀원 필터 시트</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: Pretendard, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #333;
            background-color: #fff;
        }

        /* 루트 컨테이너 (시트 전체) */
        .sheet-root {
            width: 100%;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            text-align: left;
            font-size: 1.063rem;
            color: #757575;
        }

        .bottom-sheet-header {
            align-self: stretch;
            border-radius: 20px 20px 0 0;
            background-color: #fff;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.25rem;
        }

        .bottom-sheet-header-child {
            width: 2.563rem;
            height: 0.25rem;
            border-radius: 999px;
            background-color: #ced4da;
        }

        /* 탭 네비게이션 */
        .navi {
            width: 100%;
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-sizing: border-box;
            display: flex;
            align-items: flex-start;
            padding: 0 1.5rem;
        }

        .navi-tab {
            flex: 1;
            text-align: center;
            padding: 0.875rem 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 1.063rem;
            letter-spacing: -0.03em;
            line-height: 140%;
            color: #757575;
            cursor: pointer;
            background: none;
            border: none;
        }

        .navi-tab-active {
            border-bottom: 2px solid #1e78ff;
            color: #1e78ff;
            font-weight: 600;
        }

        /* 패널 공통 레이아웃 */
        .sheet-content {
            background-color: #fff;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sheet-panel {
            display: none;
        }
        
        .sheet-panel.active {
            display: block;
            flex: 1;
            overflow-y: auto;
        }

        .frame-parent {
            width: 100%;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 1.5rem 1rem 2.5rem;
            gap: 2rem;
            text-align: right;
            font-size: 1.125rem;
            color: #333;
        }

        .frame-group {
            align-self: stretch;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .frame-wrapper {
            display: flex;
            align-items: flex-start;
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 0.125rem;
        }

        .div2 {
            letter-spacing: -0.02em;
            line-height: 140%;
            font-weight: 600;
        }

        .frame-container {
            align-self: stretch;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.25rem;
            text-align: left;
            font-size: 0.938rem;
            color: #8f8f8f;
            font-family: 'Pretendard Variable', Pretendard, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .akar-iconsbox-parent {
            align-self: stretch;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .aiit,
        .div3,
        .javascript {
            position: relative;
        }

        /* ✅ 07_03_view.php 의 익명 체크박스와 같은 형식 */
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            width: 100%;
        }

        .checkbox-label input[type="checkbox"] {
            display: none; /* 실제 체크박스 숨김 */
        }

        .checkbox-child {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            box-sizing: border-box;
            position: relative;
            flex-shrink: 0;
        }

        /* 체크 상태일 때 스타일 (✔ 모양) */
        .checkbox-label input[type="checkbox"]:checked + .checkbox-child {
            background-color: #ffffff;
            border-color: #1e78ff;
        }

        .checkbox-label input[type="checkbox"]:checked + .checkbox-child::after {
            content: "";
            position: absolute;
            left: 0.32rem;
            top: 0.08rem;
            width: 0.35rem;
            height: 0.7rem;
            border: 2px solid #1e78ff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .checkbox-text {
            font-size: 0.938rem;
            letter-spacing: -0.02em;
            line-height: 140%;
            color: #4b5563;
        }

        /* 하단 버튼 영역 공통 */
        .buttons-parent {
            align-self: stretch;
            display: flex;
            align-items: center;
            gap: 0.562rem;
            text-align: left;
            color: #475569;
            font-family: 'Spoqa Han Sans Neo', Pretendard, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .buttons {
            width: 6.938rem;
            border-radius: 10px;
            background-color: #d2e7f8;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            box-sizing: border-box;
            cursor: pointer;
        }

        .text4 {
            letter-spacing: -0.02em;
            line-height: 1.25rem;
        }

        .buttons2 {
            flex: 1;
            border-radius: 10px;
            background-color: #1e78ff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="sheet-root">

    <!-- 상단 손잡이 -->
    <div class="bottom-sheet-header">
        <div class="bottom-sheet-header-child"></div>
    </div>

    <!-- 탭 -->
    <div class="navi">
        <button type="button" class="navi-tab" data-tab="domain">관심 도메인</button>
        <button type="button" class="navi-tab" data-tab="purpose">목적</button>
        <button type="button" class="navi-tab" data-tab="tools">사용하는 툴</button>
    </div>

    <!-- 콘텐츠 -->
    <div class="sheet-content">

        <!-- 1) 관심 도메인 -->
        <div id="panel-domain" class="sheet-panel">
            <div class="frame-parent">
                <div class="frame-group">
                    <div class="frame-wrapper">
                        <div class="wrapper"><div class="div2">관심 도메인</div></div>
                    </div>

                    <div class="frame-container">
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="금융">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">금융</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="헬스케어">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">헬스케어</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="AI/데이터/IT">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">AI/데이터/IT</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="게임">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">게임</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="교육">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">교육</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="소셜/커뮤니티">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">소셜/커뮤니티</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="미디어/컨텐츠/OTT">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">미디어/컨텐츠/OTT</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="이커머스">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">이커머스</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="핀테크">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">핀테크</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="domain[]" value="모빌리티">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">모빌리티</span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 2) 목적 -->
        <div id="panel-purpose" class="sheet-panel">
            <div class="frame-parent">
                <div class="frame-group">
                    <div class="frame-wrapper">
                        <div class="wrapper"><div class="div2">목적</div></div>
                    </div>

                    <div class="frame-container">
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="부업">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">부업</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="포트폴리오">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">포트폴리오</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="취업">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">취업</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="역량 형성">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">역량 형성</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="취미/재미">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">취미/재미</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="친목/사교">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">친목/사교</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="purpose[]" value="기타">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">기타</span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3) 사용하는 툴 -->
        <div id="panel-tools" class="sheet-panel">
            <div class="frame-parent">
                <div class="frame-group">
                    <div class="frame-wrapper">
                        <div class="wrapper"><div class="div2">개발자 툴</div></div>
                    </div>

                    <div class="frame-container">
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="JavaScript">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">JavaScript</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="TypeScript">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">TypeScript</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="React">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">React</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Vue">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Vue</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Svelte">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Svelte</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Nextjs">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Nextjs</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Java">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Java</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Spring">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Spring</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Nodejs">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Nodejs</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Nestjs">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Nestjs</span>
                            </label>
                        </div>
                        <div class="akar-iconsbox-parent">
                            <label class="checkbox-label">
                                <input type="checkbox" name="tools[]" value="Go">
                                <span class="checkbox-child"></span>
                                <span class="checkbox-text">Go</span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- /sheet-content -->

    <!-- ✅ 하단 버튼은 항상 고정 -->
    <div class="buttons-parent" style="padding: 1.5rem 1rem;">
        <!-- 초기화 버튼 -->
        <div class="buttons" id="reset-btn">
            <b class="text4">초기화</b>
        </div>
        <!-- 123명 / 5명 보기 버튼 -->
        <div class="buttons2" id="apply-btn">
            <b class="text4" id="apply-btn-label">123명의 팀원 보기</b>
        </div>
    </div>

<script>
    // ============================
    // 탭 전환 (기존 로직)
    // ============================
    (function () {
        var defaultTab = "<?php echo $tab; ?>";

        var tabs = document.querySelectorAll(".navi-tab");
        var panels = {
            domain: document.getElementById("panel-domain"),
            purpose: document.getElementById("panel-purpose"),
            tools: document.getElementById("panel-tools")
        };

        function setTab(tabName) {
            tabs.forEach(t =>
                t.classList.toggle("navi-tab-active", t.dataset.tab === tabName)
            );

            Object.keys(panels).forEach(key => {
                panels[key].classList.toggle("active", key === tabName);
            });
        }

        tabs.forEach(tab =>
            tab.addEventListener("click", () => {
                setTab(tab.dataset.tab);
            })
        );

        setTab(defaultTab);
    })();
</script>

<script>
    // ============================
    // 123명 / 5명 보기 + 초기화 + postMessage
    // ============================
    document.addEventListener("DOMContentLoaded", function () {

        const APPLY_DEFAULT_LABEL = "123명의 팀원 보기"; // 체크 없음
        const APPLY_FILTER_LABEL  = "5명의 팀원 보기";   // 체크 1개 이상

        const applyBtn      = document.getElementById("apply-btn");
        const applyBtnLabel = document.getElementById("apply-btn-label");
        const resetBtn      = document.getElementById("reset-btn");

        const currentTab = "<?php echo $tab; ?>";

        // 모든 체크박스
        const allCheckboxes = document.querySelectorAll(".sheet-panel input[type='checkbox']");

        // 1) 체크 여부에 따라 버튼 라벨 변경
        function updateApplyButtonLabel() {
            let checkedCount = 0;
            allCheckboxes.forEach(cb => {
                if (cb.checked) checkedCount++;
            });

            if (checkedCount > 0) {
                applyBtnLabel.textContent = APPLY_FILTER_LABEL;
            } else {
                applyBtnLabel.textContent = APPLY_DEFAULT_LABEL;
            }
        }

        allCheckboxes.forEach(cb => {
            cb.addEventListener("change", updateApplyButtonLabel);
        });

        // 3) 초기화 버튼: 체크 박스 모두 해제 + 라벨 초기화
        if (resetBtn) {
            resetBtn.addEventListener("click", function () {
                allCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
                updateApplyButtonLabel();
            });
        }

        // 현재 탭(panel-XXX)에서 선택된 값 모으기
        function getSelectedValuesByTab(tabName) {
            const panel = document.getElementById("panel-" + tabName);
            if (!panel) return [];

            const checked = panel.querySelectorAll("input[type='checkbox']:checked");
            const values = [];
            checked.forEach(cb => values.push(cb.value));
            return values;
        }

        // 2) 123명 / 5명 보기 버튼 클릭 시 부모에게 postMessage
        if (applyBtn) {
            applyBtn.addEventListener("click", function () {

                const isFiveMode = (applyBtnLabel.textContent.indexOf("5명") !== -1);
                const mode = isFiveMode ? "five" : "all";

                const selectedValues = getSelectedValuesByTab(currentTab);

                // 부모 창(06_view)으로 메시지 전송
                window.parent.postMessage(
                    {
                        source: "teamFilterSheet",
                        action: "applyFilter",
                        tab: currentTab,
                        mode: mode,          // "all" 또는 "five"
                        selected: selectedValues
                    },
                    "*"
                );
            });
        }

        // 처음 진입 시 라벨 세팅
        updateApplyButtonLabel();
    });
</script>

</body>
</html>
