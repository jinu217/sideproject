<?php
// ===========================
// common/layout.php : 모바일/WebView 전용 레이아웃
// ===========================

// 기본값 세팅
if (!isset($showNav))     $showNav     = true;
if (!isset($pageTitle))   $pageTitle   = 'Tishoo';
if (!isset($pageCss))     $pageCss     = null;
if (!isset($extraCss))    $extraCss    = [];
if (!isset($view))        $view        = '';
if (!isset($bottomFixed)) $bottomFixed = null;
if (!isset($isModal))     $isModal     = false;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">

    <!-- 🔥 모바일/WebView에 최적화: PC 대응 불필요 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- 폰트 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css">

    <!-- ===========================
         모바일 전용 공통 스타일
         =========================== -->
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: #FFF;
            overscroll-behavior-y: contain; /* 당기면 탄성 줄이기 */
        }

        body {
            font-family: Pretendard, sans-serif;
        }

        /* 전체 앱 컨테이너 (PC 가운데 정렬 삭제) */
        .app-root {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* 콘텐츠 페이지 (PC max-width 제거) */
        .app-page {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: #FFFFFF;
            position: relative;
        }

        /* 스크롤 영역 */
        .app-main {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .app-main::-webkit-scrollbar {
            display: none;
        }
    </style>

    <?php
    // 페이지 단위 CSS
    if (!empty($pageCss)) {
        if (is_array($pageCss)) {
            foreach ($pageCss as $css) {
                echo '<link rel="stylesheet" href="' . htmlspecialchars($css) . '">' . PHP_EOL;
            }
        } else {
            echo '<link rel="stylesheet" href="' . htmlspecialchars($pageCss) . '">' . PHP_EOL;
        }
    }

    // 추가 CSS
    if (!empty($extraCss)) {
        foreach ($extraCss as $css) {
            echo '<link rel="stylesheet" href="' . htmlspecialchars($css) . '">' . PHP_EOL;
        }
    }
    ?>

</head>
<body>

<?php if (!$isModal): ?>
<div class="app-root">
    <div class="app-page">

        <main class="app-main">
            <?php
            if (!empty($view) && file_exists($view)) {
                include $view;
            } else {
                echo '<p>뷰 파일이 설정되지 않았습니다.</p>';
            }
            ?>
        </main>

        <?php
        if (!empty($bottomFixed) && file_exists($bottomFixed)) {
            include $bottomFixed;
        } elseif (!empty($showNav) && $showNav) {
            include __DIR__ . '/nav.php';
        }
        ?>
    </div>
</div>

<?php else: ?>
    <!-- 모달 전용 -->
    <?php include $view; ?>
<?php endif; ?>

</body>
</html>
