-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 25-11-25 12:15
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `tishoo`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `peer_reviews`
--

CREATE TABLE `peer_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL COMMENT '어떤 프로젝트에 대한 후기인지',
  `reviewer_id` int(10) UNSIGNED NOT NULL COMMENT '후기를 남긴 사람 users.id',
  `target_user_id` int(10) UNSIGNED NOT NULL COMMENT '후기를 받는 사람 users.id',
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT '1~5점',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '콤마로 연결된 키워드들',
  `comment` text NOT NULL COMMENT '한 줄 후기',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1이면 익명',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `peer_reviews`
--

INSERT INTO `peer_reviews` (`id`, `project_id`, `reviewer_id`, `target_user_id`, `rating`, `keywords`, `comment`, `is_anonymous`, `created_at`) VALUES
(1, 1, 2, 6, 5, '소통이 잘돼요,책임감 있어요', '프로젝트 전반에서 디자인 방향을 잘 잡아주고 커뮤니케이션이 매끄러웠어요.', 0, '2025-11-25 19:27:04'),
(2, 1, 4, 1, 4, '리드해줘요,빠르게 대응해요', '백엔드 쪽 이슈가 생겨도 빠르게 대응해줘서 든든했어요.', 1, '2025-11-25 19:27:04'),
(3, 2, 6, 4, 5, '아이디어가 좋아요,소통이 잘돼요', '기획 단계에서 아이디어 정리가 인상적이었고 회의 진행이 매끄러웠습니다.', 0, '2025-11-25 19:27:04'),
(4, 1, 1, 3, 5, '', '엄청 잘하세요!', 0, '2025-11-25 19:27:51'),
(5, 1, 4, 3, 5, '', '진짜 잘하세요!', 0, '2025-11-25 19:39:47'),
(6, 1, 4, 3, 5, '', '진짜 잘하세요!', 0, '2025-11-25 19:39:55'),
(7, 1, 4, 3, 5, '', '진짜 잘하세요!', 0, '2025-11-25 19:40:07'),
(8, 1, 4, 3, 5, '빠르게 대응해요', '진짜 잘하세요!', 0, '2025-11-25 19:40:10'),
(9, 1, 1, 3, 5, '리드해줘요', '엄청 잘하세요', 0, '2025-11-25 19:43:18'),
(10, 1, 1, 6, 5, '', '진짜 잘하세요!', 0, '2025-11-25 19:51:32'),
(11, 1, 1, 5, 5, '', '잘하세요', 0, '2025-11-25 19:53:48'),
(12, 1, 1, 6, 5, '', '잘하세요', 0, '2025-11-25 19:55:53'),
(13, 1, 1, 1, 5, '', '개잘해요', 0, '2025-11-25 20:06:47'),
(14, 1, 1, 4, 5, '', '엄청 잘하세요!', 1, '2025-11-25 20:08:42');

-- --------------------------------------------------------

--
-- 테이블 구조 `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL COMMENT '프로젝트 제목',
  `description` text DEFAULT NULL COMMENT '프로젝트 설명',
  `start_date` date DEFAULT NULL COMMENT '시작일',
  `end_date` date DEFAULT NULL COMMENT '종료일',
  `status` enum('recruiting','in_progress','finished') NOT NULL DEFAULT 'in_progress' COMMENT '상태',
  `created_by` int(10) UNSIGNED NOT NULL COMMENT '생성자 users.id',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '사이드프로젝트 플랫폼 Tishoo MVP', '완주율과 동료후기를 기반으로 신뢰를 쌓는 사이드프로젝트 플랫폼', '2025-10-01', '2025-11-30', 'in_progress', 1, '2025-11-25 19:26:48', NULL),
(2, '대학생 맞춤 AI 플랫폼', '대학생 타겟 AI 도우미 서비스 기획/개발', '2025-09-01', '2025-12-31', 'in_progress', 4, '2025-11-25 19:26:48', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `project_members`
--

CREATE TABLE `project_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_in_project` varchar(100) DEFAULT NULL COMMENT '프로젝트 내 역할(예: 팀장, 디자이너 등)',
  `is_leader` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1이면 리더',
  `joined_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`, `role_in_project`, `is_leader`, `joined_at`) VALUES
(1, 1, 1, '백엔드 개발', 1, '2025-11-25 19:26:54'),
(2, 1, 2, '프론트엔드 개발', 0, '2025-11-25 19:26:54'),
(3, 1, 3, 'UI/UX 디자인', 0, '2025-11-25 19:26:54'),
(4, 1, 4, '기획 / PM', 0, '2025-11-25 19:26:54'),
(5, 1, 5, '데이터 분석', 0, '2025-11-25 19:26:54'),
(6, 1, 6, 'UI/UX 디자인', 0, '2025-11-25 19:26:54'),
(7, 1, 7, '기획', 0, '2025-11-25 19:26:54'),
(8, 1, 8, '풀스택 개발', 0, '2025-11-25 19:26:54'),
(9, 2, 1, '백엔드 개발', 0, '2025-11-25 19:26:59'),
(10, 2, 3, 'UI/UX 디자인', 0, '2025-11-25 19:26:59'),
(11, 2, 4, '기획 / PM', 1, '2025-11-25 19:26:59'),
(12, 2, 6, 'UI/UX 디자인', 0, '2025-11-25 19:26:59'),
(13, 2, 8, '풀스택 개발', 0, '2025-11-25 19:26:59');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '이름',
  `email` varchar(100) DEFAULT NULL COMMENT '이메일(선택)',
  `role` varchar(100) NOT NULL COMMENT '역할(예: 백엔드 개발자, UI/UX 디자이너, 기획자 등)',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, '김진우', 'jinwoo@example.com', '백엔드 개발자', '2025-11-25 19:26:43', NULL),
(2, '임재이', 'jae.example.com', '프론트엔드 개발자', '2025-11-25 19:26:43', NULL),
(3, '김민경', 'minkyung@example.com', 'UI/UX 디자이너', '2025-11-25 19:26:43', NULL),
(4, '김호진', 'hojin@example.com', '기획자 / PM', '2025-11-25 19:26:43', NULL),
(5, '박주안', 'juan@example.com', '데이터 분석가', '2025-11-25 19:26:43', NULL),
(6, '이수아', 'sua@example.com', 'UI/UX 디자이너', '2025-11-25 19:26:43', NULL),
(7, '조태연', 'taeyeon@example.com', '기획자', '2025-11-25 19:26:43', NULL),
(8, '허윤선', 'yoonseon@example.com', '풀스택 개발자', '2025-11-25 19:26:43', NULL);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `peer_reviews`
--
ALTER TABLE `peer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pr_target` (`target_user_id`),
  ADD KEY `idx_pr_project` (`project_id`),
  ADD KEY `idx_pr_reviewer` (`reviewer_id`);

--
-- 테이블의 인덱스 `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_creator` (`created_by`);

--
-- 테이블의 인덱스 `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_pm_project_user` (`project_id`,`user_id`),
  ADD KEY `fk_pm_user` (`user_id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `peer_reviews`
--
ALTER TABLE `peer_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `peer_reviews`
--
ALTER TABLE `peer_reviews`
  ADD CONSTRAINT `fk_pr_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pr_reviewer` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pr_target` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `fk_pm_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pm_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
