<!-- common/nav.php : 충돌 방지를 위해 모든 클래스 nav- 로 변경 -->

<style>
/* NAV ROOT */
.nav-wrapper {
    width: 100%;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    background: transparent;
    font-family: Pretendard, sans-serif;
}

/* 네비 본체 */
.nav-container {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-end;
    background: #fff;
    border-top: 1px solid #f1f1f1;
    padding: 1.5rem 2.5rem;
    box-shadow: 0px 4px 6px rgba(0,0,0,0.06);
    position: relative;
    overflow: visible; /* 플로팅 버튼 가림 방지 */
}

/* 개별 탭: 아이콘 위 / 텍스트 아래 */
.nav-tab {
    width: 2.375rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.275rem;
}

/* 아이콘 박스 */
.nav-icon-box {
    width: 1.35rem;
    height: 1.35rem;
    position: relative;
}

.nav-icon-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* 텍스트 */
.nav-label {
    font-size: 0.75rem;
    line-height: 1rem;
    font-weight: 500;
    color: #c1c1c1;
}

.nav-label-active {
    color: #0c0c0c;
}

/* 중앙 플로팅 버튼 */
.nav-floating-btn {
    width: 3.375rem;
    height: 3.375rem;
    position: absolute;
    top: -1.5rem;
    left: calc(50% - 1.7rem);
    border-radius: 99px;
    box-shadow: 0px 2px 4px rgba(30,120,255,0.12),
                0px 10px 12px 8px rgba(30,120,255,0.1);
    object-fit: contain;
    cursor: pointer;
    z-index: 10;
}
</style>


<div class="nav-wrapper">
    <div class="nav-container">

        <!-- 탭 1: Square -->
        <div class="nav-tab">
            <div class="nav-icon-box">
                <img src="../img/tab1_off.svg" alt="Square">
            </div>
            <div class="nav-label">Square</div>
        </div>

        <!-- 탭 2: Project -->
        <div class="nav-tab">
            <div class="nav-icon-box">
                <img src="../img/tab2_on.svg" alt="Project">
            </div>
            <div class="nav-label nav-label-active">Project</div>
        </div>

        <!-- 탭 3: Chat -->
        <div class="nav-tab">
            <div class="nav-icon-box">
                <img src="../img/tab3_off.svg" alt="Chat">
            </div>
            <div class="nav-label">Chat</div>
        </div>

        <!-- 탭 4: My -->
        <div class="nav-tab">
            <div class="nav-icon-box">
                <img src="../img/tab4_off.svg" alt="My">
            </div>
            <div class="nav-label">My</div>
        </div>

        <!-- 중앙 플로팅 버튼 -->
        <img src="../img/floating_button.svg" class="nav-floating-btn" id="navFloatingBtn" alt="Add">

    </div>
</div>

<script>
document.getElementById("navFloatingBtn")?.addEventListener("click", () => {
    window.location.href = "04_01_new_project.php";
});
</script>
