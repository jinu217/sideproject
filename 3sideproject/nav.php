<div class="phone-nav" style="
    width: 100%;
    position: relative;  /* 플로팅 버튼 기준 */
">

    <!-- 네비게이션 바 -->
    <div style="
        width: 100%; 
        padding-top: 25px; 
        padding-bottom: 20px;  
        background: white; 
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.06); 
        border-top: 1px #F1F1F1 solid; 
        display: inline-flex; 
        justify-content: center; 
        align-items: flex-end; 
        gap: 48.76px;
    ">
        <!-- Square -->
        <div style="width: 38px; display:flex; flex-direction:column; align-items:center; gap:4.42px;">
            <img src="img/tab1_off.svg" style="width:20.92px; height:20.92px;">
            <div style="color:#C1C1C1; font-size:11.57px; font-weight:500;">Square</div>
        </div>

        <!-- Project -->
        <div style="width: 38px; display:flex; flex-direction:column; align-items:center; gap:4.42px;">
            <img src="img/tab2_on.svg" style="width:23.81px; height:21.11px;">
            <div style="color:#0C0C0C; font-size:11.57px; font-weight:700;">Project</div>
        </div>

        <!-- Chat -->
        <div style="width: 38px; display:flex; flex-direction:column; align-items:center; gap:4.42px;">
            <img src="img/tab3_off.svg" style="width:18.97px; height:20.64px;">
            <div style="color:#C1C1C1; font-size:11.57px; font-weight:500;">Chat</div>
        </div>

        <!-- My -->
        <div style="width: 38px; display:flex; flex-direction:column; align-items:center; gap:3.53px;">
            <img src="img/tab4_off.svg" style="width:21.58px; height:20.93px;">
            <div style="color:#C1C1C1; font-size:11.57px; font-weight:500;">My</div>
        </div>
    </div>

    <!-- 플로팅 버튼 -->
    <a href="03_01_new_project.php"
       style="
        width: 54px;
        height: 54px;
        position: absolute;
        left: 50%;
        top: -25px;
        transform: translateX(-50%);
        background: #1E78FF;
        box-shadow: 0px 10px 12px 8px rgba(30, 120, 255, 0.10);
        border-radius: 99px;
        outline: 3px white solid;
        outline-offset: -3px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    ">
        <div style="width: 16px; height: 16px; background: white;"></div>
    </a>
</div>
