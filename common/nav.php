<?php
// common/nav.php : 하단 네비게이션 (충돌 없는 전용 클래스 버전)

// 활성 탭
if (!isset($activeTab)) {
    $activeTab = '';
}

$currentUserId = isset($current_user_id)
    ? (int)$current_user_id
    : (isset($_GET['user']) ? (int)$_GET['user'] : 1);

if ($currentUserId <= 0) $currentUserId = 1;

$tabAssets = [
    'square'  => ['on' => '../img/tab1_on.svg', 'off' => '../img/tab1_off.svg'],
    'project' => ['on' => '../img/tab2_on.svg', 'off' => '../img/tab2_off.svg'],
    'chat'    => ['on' => '../img/tab3_on.svg', 'off' => '../img/tab3_off.svg'],
    'my'      => ['on' => '../img/tab4_on.svg', 'off' => '../img/tab4_off.svg'],
];

function navIcon($name, $activeTab, $assets) {
    return ($name === $activeTab) ? $assets[$name]['on'] : $assets[$name]['off'];
}

function navLabelClass($name, $activeTab) {
    return ($name === $activeTab) ? 'nav-label nav-label-active' : 'nav-label';
}
?>

<style>
/* ================= NAV WRAPPER ================= */
.nav-wrapper {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: center;
    background: transparent;
    font-family: Pretendard, sans-serif;
}

/* ================= NAV BAR (전체 영역) ================= */
.nav-bar {
    width: 100%;
    background: #fff;
    border-top: 1px solid #f1f1f1;
    box-shadow: 0px -2px 6px rgba(0,0,0,0.06);

    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-end;

    padding: 1rem 2.5rem;
    gap: 1.25rem;

    font-size: 0.688rem;
    color: #bdbdbd;
}

/* ================= NAV 개별 아이템 ================= */
.nav-item-home,
.nav-item-project,
.nav-item-chat,
.nav-item-my {
    width: 3rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    cursor: pointer;
}

/* ================= NAV 아이콘 ================= */
.nav-icon-home,
.nav-icon-project,
.nav-icon-chat,
.nav-icon-my {
    width: 1.6rem;
    height: 1.6rem;
    object-fit: contain;
}

/* 홈 아이콘만 크기 다름 */
.nav-icon-home {
    width: 1.5rem;
    height: 1.5rem;
}

/* ================= NAV 텍스트 ================= */
.nav-label {
    font-weight: 500;
    color: #bdbdbd !important;
}

.nav-label-active {
    color: #0c0c0c !important;
}

/* ================= 플로팅 버튼 ================= */
.nav-floating-btn {
    width: 3.375rem;
    height: 3.375rem;
    position: absolute;
    top: -1.6rem;
    left: calc(50% - 1.7rem);
    border-radius: 50%;
    box-shadow:
        0px 2px 4px rgba(30,120,255,0.12),
        0px 10px 12px 8px rgba(30,120,255,0.1);
    cursor: pointer;
}
</style>

<div class="nav-wrapper">
    <div class="nav-bar">

        <!-- 홈 -->
        <div class="nav-item-home" id="nav-home">
            <img src="<?= navIcon('square', $activeTab, $tabAssets); ?>" class="nav-icon-home">
            <div class="<?= navLabelClass('square', $activeTab); ?>">홈</div>
        </div>

        <!-- 프로젝트 -->
        <div class="nav-item-project" id="nav-project">
            <img src="<?= navIcon('project', $activeTab, $tabAssets); ?>" class="nav-icon-project">
            <div class="<?= navLabelClass('project', $activeTab); ?>">프로젝트</div>
        </div>

        <!-- 채팅 -->
        <div class="nav-item-chat" id="nav-chat">
            <img src="<?= navIcon('chat', $activeTab, $tabAssets); ?>" class="nav-icon-chat">
            <div class="<?= navLabelClass('chat', $activeTab); ?>">채팅</div>
        </div>

        <!-- 마이페이지 -->
        <div class="nav-item-my" id="nav-my">
            <img src="<?= navIcon('my', $activeTab, $tabAssets); ?>" class="nav-icon-my">
            <div class="<?= navLabelClass('my', $activeTab); ?>">마이페이지</div>
        </div>

        <!-- 플로팅 버튼 -->
        <img src="../img/floating_button.svg" class="nav-floating-btn" id="navFloatingBtn">

    </div>
</div>

<script>
document.getElementById("nav-home")?.addEventListener("click", () => {
    location.href = "00_home.php";
});
document.getElementById("nav-project")?.addEventListener("click", () => {
    location.href = "01_project.php";
});
document.getElementById("nav-chat")?.addEventListener("click", () => {
    location.href = "02_chatting.php";
});
document.getElementById("nav-my")?.addEventListener("click", () => {
    location.href = "03_mypage.php?user=<?= $currentUserId ?>";
});
document.getElementById("navFloatingBtn")?.addEventListener("click", () => {
    location.href = "04_01_new_project.php";
});
</script>
