<?php
// 09_user_profile.php : 유저 프로필 화면

$pageTitle = '유저 프로필 | Tishoo';
$pageCss = [
    '../page/css/09_view.css',        // 상단 헤더, 카드, 상단 탭 네비 등 공통
    '../page/css/09_01_view_tab_profile.css', // 프로필 탭
    '../page/css/09_02_view_tab_project.css', // 프로젝트 탭
    '../page/css/09_03_view_tab_portfolio.css', // 포트폴리오 탭 (임시 비워도 됨)
    '../page/css/09_04_view_tab_review.css',  // 동료후기 탭
];

$view        = __DIR__ . '/view/09_view.php';
$showNav     = true;
$activeTab = 'project';
include __DIR__ . '/../common/layout.php';


