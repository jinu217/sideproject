<?php
// /tishoo/page/03_project_detail.php 같은 데서

$pageTitle   = '프로젝트 상세 | Tishoo';
$pageCss = [
    '/tishoo/page/css/03_view.css',           // 메인 화면 레이아웃
    '/tishoo/page/css/03_01_view_tab_detail.css',    // 상세정보 탭 CSS
    '/tishoo/page/css/03_02_view_tab_team.css',      // 팀정보 탭 CSS
    '/tishoo/page/css/03_03_view_tab_progress.css',  // 진행도 탭 CSS
    '/tishoo/page/css/03_04_view_tab_qna.css',       // QnA 탭 CSS
];
$view        = __DIR__ . '/view/03_view.php';
$showNav     = false; 
$bottomFixed = __DIR__ . '/../common/detail_footer.php';

include __DIR__ . '/../common/layout.php';