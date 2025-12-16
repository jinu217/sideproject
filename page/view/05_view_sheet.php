<?php
// 05_view_sheet.php : 프로젝트 목록 필터 바텀시트 (도메인 / 포지션 / 목적)

// GET 파라미터(tab) 받기
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'domain';

// 허용된 탭만 사용
$allowedTabs = ['domain', 'position', 'purpose'];
if (!in_array($tab, $allowedTabs, true)) {
    $tab = 'domain';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, width=device-width">

<style>
    * { margin:0; padding:0; box-sizing:border-box; }

    html, body {
        height: 100%;
    }
    
    body {
        background:#fff;
        font-family:Pretendard, sans-serif;
        color:#333;
    }

    .sheet-root {
        width:100%;
        min-height:100%;
        display:flex;
        flex-direction:column;
    }

    .sheet-header {
        padding:0.75rem 1.25rem 0.25rem;
        display:flex;
        justify-content:center;
    }
    .sheet-header-bar {
        width:2.563rem;
        height:0.25rem;
        background:#ced4da;
        border-radius:999px;
    }

    .navi {
        width:100%;
        display:flex;
        background:#fff;
        border-bottom:1px solid #e2e8f0;
        padding:0 1.5rem;
    }
    .navi-tab {
        flex:1;
        text-align:center;
        padding:0.875rem 0;
        font-size:1.063rem;
        color:#757575;
        border-bottom:1px solid #e2e8f0;
        cursor:pointer;
    }
    .navi-tab-active {
        border-bottom:2px solid #1e78ff;
        color:#1e78ff;
        font-weight:600;
    }

    .sheet-panel { display:none; }
    .sheet-panel.active {
        display:block;
        flex:1;
        overflow-y:auto;
    }

    .panel-inner {
        padding:1.5rem 1rem 2rem;
        display:flex;
        flex-direction:column;
        gap:1.5rem;
    }

    .panel-title {
        font-size:1.125rem;
        font-weight:600;
        letter-spacing:-0.02em;
    }

    .option-list {
        display:flex;
        flex-direction:column;
        gap:1rem;
    }

    .checkbox-label {
        display:flex;
        align-items:center;
        gap:0.6rem;
        cursor:pointer;
        width:100%;
    }
    .checkbox-label input { display:none; }
    .checkbox-box {
        width:1.25rem;
        height:1.25rem;
        border:1px solid #cbd5e1;
        border-radius:4px;
        background:#fff;
        position:relative;
    }
    .checkbox-label input:checked + .checkbox-box {
        border-color:#1e78ff;
    }
    .checkbox-label input:checked + .checkbox-box::after {
        content:"";
        width:0.35rem;
        height:0.7rem;
        border:2px solid #1e78ff;
        border-top:none;
        border-left:none;
        position:absolute;
        top:0.08rem;
        left:0.32rem;
        transform:rotate(45deg);
    }
    .checkbox-text {
        font-size:0.95rem;
        color:#555;
    }

    .bottom-area {
        padding:1.25rem 1rem 2rem;
        display:flex;
        gap:0.6rem;
    }
    .btn-reset {
        width:7rem;
        background:#d2e7f8;
        padding:0.9rem;
        border-radius:10px;
        text-align:center;
        font-weight:600;
        color:#475569;
        cursor:pointer;
    }
    .btn-apply {
        flex:1;
        background:#1e78ff;
        padding:0.9rem;
        border-radius:10px;
        text-align:center;
        font-weight:600;
        color:#fff;
        cursor:pointer;
    }
</style>

</head>
<body>

<div class="sheet-root">

    <div class="sheet-header">
        <div class="sheet-header-bar"></div>
    </div>

    <div class="navi">
        <div class="navi-tab" data-tab="domain">도메인</div>
        <div class="navi-tab" data-tab="position">포지션</div>
        <div class="navi-tab" data-tab="purpose">목적</div>
    </div>

    <div id="panel-domain" class="sheet-panel">
        <div class="panel-inner">
            <div class="panel-title">도메인</div>
            <div class="option-list">
                <?php
                $domains = ["금융","헬스케어","AI/데이터/IT","게임","교육","소셜/커뮤니티","미디어/컨텐츠/OTT","이커머스","핀테크","모빌리티"];
                foreach($domains as $d):
                ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="domain[]" value="<?= $d ?>">
                    <span class="checkbox-box"></span>
                    <span class="checkbox-text"><?= $d ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="panel-position" class="sheet-panel">
        <div class="panel-inner">
            <div class="panel-title">포지션</div>
            <div class="option-list">
                <?php
                $positions = ["기획자","디자이너","백엔드","프론트엔드"];
                foreach($positions as $p):
                ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="position[]" value="<?= $p ?>">
                    <span class="checkbox-box"></span>
                    <span class="checkbox-text"><?= $p ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="panel-purpose" class="sheet-panel">
        <div class="panel-inner">
            <div class="panel-title">목적</div>
            <div class="option-list">
                <?php
                $purposes = ["부업","창업","포트폴리오","취업","역량 형성","취미/재미","친목/사교","기타"];
                foreach($purposes as $p):
                ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="purpose[]" value="<?= $p ?>">
                    <span class="checkbox-box"></span>
                    <span class="checkbox-text"><?= $p ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="bottom-area">
        <div class="btn-reset">초기화</div>
        <div class="btn-apply">234개의 프로젝트 보기</div>
    </div>

</div>

<script>
(function(){
    const defaultTab = "<?= $tab ?>";
    const tabs = document.querySelectorAll(".navi-tab");
    const panels = {
        domain: document.getElementById("panel-domain"),
        position: document.getElementById("panel-position"),
        purpose: document.getElementById("panel-purpose")
    };

    function setTab(tabName){
        tabs.forEach(t => t.classList.toggle("navi-tab-active", t.dataset.tab === tabName));
        Object.keys(panels).forEach(key => {
            panels[key].classList.toggle("active", key === tabName);
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", () => setTab(tab.dataset.tab));
    });

    setTab(defaultTab);
})();

// =================================
// 체크박스 상태 감지 → 버튼 텍스트 변경
// =================================
const allCheckboxes = document.querySelectorAll("input[type='checkbox']");
const applyBtn = document.querySelector(".btn-apply");
const resetBtn = document.querySelector(".btn-reset");

const DEFAULT_COUNT = 234;
const FILTERED_COUNT = 3;

allCheckboxes.forEach(chk => chk.addEventListener("change", updateProjectCount));

function updateProjectCount() {
    const checked = document.querySelectorAll("input[type='checkbox']:checked").length;
    applyBtn.textContent = (checked === 0)
        ? `${DEFAULT_COUNT}개의 프로젝트 보기`
        : `${FILTERED_COUNT}개의 프로젝트 보기`;
}

// =================================
// 초기화
// =================================
resetBtn.addEventListener("click", function () {
    allCheckboxes.forEach(chk => chk.checked = false);
    applyBtn.textContent = `${DEFAULT_COUNT}개의 프로젝트 보기`;
});

applyBtn.addEventListener("click", function () {

    const checkedCount = document.querySelectorAll("input[type='checkbox']:checked").length;

    // 0개 선택 → 전체 프로젝트 보기 (필터 리셋)
    if (checkedCount === 0) {
        window.parent.postMessage({ action: "resetFilter" }, "*");
        window.parent.closeFilterSheet();
        return;
    }

    // 1개 이상 선택 → 부모창 카드 변경 요청 (3개만 남기기)
    window.parent.postMessage({ action: "applyFilter", count: 3 }, "*");

    // 바텀시트 닫기
    window.parent.closeFilterSheet();
});

</script>

</body>
</html>
