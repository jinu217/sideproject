<?php
// /08_project_detail.php : 프로젝트 상세 페이지

$pageTitle   = '프로젝트 상세 | Tishoo';
$pageCss = [
    '../page/css/08_view.css',           // 메인 화면 레이아웃
    '../page/css/08_01_view_tab_detail.css',    // 상세정보 탭 CSS
    '../page/css/08_02_view_tab_team.css',      // 팀정보 탭 CSS
    '../page/css/08_03_view_tab_progress.css',  // 진행도 탭 CSS
    '../page/css/08_04_view_tab_qna.css',       // QnA 탭 CSS
];
$view        = __DIR__ . '/view/08_view.php';
$showNav     = false; 
$bottomFixed = __DIR__ . '/../common/detail_footer.php';

include __DIR__ . '/../common/layout.php';