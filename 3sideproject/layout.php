<?php
  if (!isset($showNav)) {
      $showNav = true;
  }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>3 사이드 프로젝트</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>

<div class="phone-frame" style="position: relative;">  <!-- ✅ 기준 컨테이너 -->

    <div class="phone-screen">
        <?php
        if (isset($view)) {
            include $view;
        }
        ?>
    </div>

    <?php
    if (isset($bottomFixed)) {
        include $bottomFixed;
    } elseif ($showNav) {
        include 'nav.php';
    }
    ?>

    <!-- ✅ 여기부터는 phone-frame 내부에 넣기 -->

    <div id="modalOverlay"
         style="
            display:none;
            position: absolute;   /* ✅ fixed → absolute */
            left:0; top:0;
            width:100%; height:100%;  /* ✅ phone-frame 영역만 덮음 */
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(1px);
            z-index: 500;
         ">
    </div>

    <div id="modalBox"
         style="
            display:none;
            position: absolute;   /* ✅ fixed → absolute */
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 363px;          
            max-width: 90vw;       
            height: 487px;         
            max-height: 80vh;
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            z-index: 600;
         ">
        <iframe id="modalFrame"
                src=""
                scrolling="no"
                style="border:0; width:100%; height:100%; overflow:hidden;"></iframe>
    </div>

</div> <!-- /.phone-frame -->

<script>
function openModal(pageUrl) {
    var overlay = document.getElementById("modalOverlay");
    var box = document.getElementById("modalBox");
    var frame = document.getElementById("modalFrame");

    if (!overlay || !box || !frame) return;

    frame.src = pageUrl;                
    overlay.style.display = "block";
    box.style.display = "block";
}

function closeModal() {
    var overlay = document.getElementById("modalOverlay");
    var box = document.getElementById("modalBox");
    var frame = document.getElementById("modalFrame");

    if (!overlay || !box || !frame) return;

    overlay.style.display = "none";
    box.style.display = "none";
    frame.src = "";                  
}

document.getElementById("modalOverlay").addEventListener("click", closeModal);
</script>

</body>
</html>
