<?php
// 06_user_profile.php : 유저 프로필 화면

$pageTitle = '유저 프로필 | Tishoo';
$pageCss = [
    '/tishoo/page/css/06_view.css',        // 상단 헤더, 카드, 상단 탭 네비 등 공통
    '/tishoo/page/css/06_01_view_tab_profile.css', // 프로필 탭
    '/tishoo/page/css/06_02_view_tab_project.css', // 프로젝트 탭
    '/tishoo/page/css/06_03_view_tab_portfolio.css', // 포트폴리오 탭 (임시 비워도 됨)
    '/tishoo/page/css/06_04_view_tab_review.css',  // 동료후기 탭
];

$view        = __DIR__ . '/view/06_view.php';
$showNav     = true;

include __DIR__ . '/../common/layout.php';


