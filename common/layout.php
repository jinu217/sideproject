<?php
// ===========================
// common/layout.php : 공통 레이아웃
// ===========================

// 기본값 세팅
if (!isset($showNav))     $showNav     = true;                 // 하단 nav 사용 여부
if (!isset($pageTitle))   $pageTitle   = 'Tishoo';             // <title>
if (!isset($pageCss))     $pageCss     = null;                 // 문자열 or 배열
if (!isset($extraCss))    $extraCss    = [];                   // 추가 CSS 배열
if (!isset($view))        $view        = '';                   // 본문 view 파일 경로
if (!isset($bottomFixed)) $bottomFixed = null;                 // 하단 고정 영역 파일
if (!isset($isModal))     $isModal     = false;                // 🔑 모달인지 여부 (iframe 안에서만 true)
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- 공통 스타일 (폰 프레임 등) -->
    <link rel="stylesheet" href="/tishoo/common/phone_frame.css">

    <?php
    // 페이지 전용 CSS (문자열/배열 모두 지원)
    if (!empty($pageCss)) {
        if (is_array($pageCss)) {
            foreach ($pageCss as $css) {
                echo '<link rel="stylesheet" href="' . htmlspecialchars($css, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
            }
        } else {
            echo '<link rel="stylesheet" href="' . htmlspecialchars($pageCss, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
        }
    }

    // 추가 CSS
    if (!empty($extraCss) && is_array($extraCss)) {
        foreach ($extraCss as $css) {
            echo '<link rel="stylesheet" href="' . htmlspecialchars($css, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
        }
    }
    ?>

    <?php if (!$isModal): ?>
    <!-- 🔔 공통 모달 오버레이 CSS (전체 페이지용) -->
    <style>
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  backdrop-filter: blur(1.05px);
  -webkit-backdrop-filter: blur(1.05px);
  display: none;
  justify-content: center;
  align-items: flex-start;
  padding-top: 7.5rem;  /* 🔥 2.5rem → 4.5rem 로 늘리기 */
  z-index: 9999;
}


      .modal-iframe-wrapper {
        width: 100%;
        max-width: 370px;              /* phone-frame 너비 기준 */
        padding: 0 1rem;
        box-sizing: border-box;
      }

      .modal-iframe {
        width: 336px;
        height: 461px;            
        border: none;
        border-radius: 16px;
        box-shadow:
            0 0 2px rgba(0,0,0,0.08),
            0 8px 16px rgba(0,0,0,0.12);
        background: transparent;
        }

    </style>
    <?php endif; ?>
</head>
<body>

<?php if (!$isModal): ?>
    <!-- ===========================
         일반 페이지용 phone-frame
         =========================== -->
    <div class="app-root">
        <div class="phone-frame">
            <div class="phone-screen">
                <?php
                if (!empty($view) && file_exists($view)) {
                    include $view;
                } else {
                    echo '<p>뷰 파일이 설정되지 않았습니다.</p>';
                }
                ?>
            </div>

            <?php
            // 하단 고정 영역 (있으면 우선)
            if (!empty($bottomFixed) && file_exists($bottomFixed)) {
                include $bottomFixed;
            }
            // nav 사용
            elseif (!empty($showNav) && $showNav) {
                $navFile = __DIR__ . '/nav.php';
                if (file_exists($navFile)) {
                    include $navFile;
                }
            }
            ?>
        </div>

        <!-- 🔔 공통 모달 오버레이 (iframe 안에 모달 페이지 로드) -->
        <div id="modalOverlay" class="modal-overlay">
          <div class="modal-iframe-wrapper">
            <iframe id="modalFrame" class="modal-iframe" src="about:blank" title="Modal"></iframe>
          </div>
        </div>
    </div>

    <!-- ===========================
         공통 모달 JS
         =========================== -->
    <script>
      // 전역에서 호출: openModal('05_01_project_finich.php');
      function openModal(url) {
        var overlay = document.getElementById('modalOverlay');
        var frame   = document.getElementById('modalFrame');
        if (!overlay || !frame) return;

        frame.src = url;
        overlay.style.display = 'flex';
        document.body.style.overflow = 'hidden';  // 배경 스크롤 방지
      }

      function closeModal() {
        var overlay = document.getElementById('modalOverlay');
        var frame   = document.getElementById('modalFrame');
        if (!overlay || !frame) return;

        overlay.style.display = 'none';
        frame.src = 'about:blank';
        document.body.style.overflow = '';
      }
    </script>

<?php else: ?>
    <!-- ===========================
         모달 전용 레이아웃 (phone-frame X)
         이 안에는 순수 view만 들어감
         =========================== -->
    <?php
    if (!empty($view) && file_exists($view)) {
        include $view;
    } else {
        echo '<p>모달 뷰 파일이 설정되지 않았습니다.</p>';
    }
    ?>
<?php endif; ?>

</body>
</html>
