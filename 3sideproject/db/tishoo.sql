-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 25-11-22 15:33
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
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `peer_reviews`
--

INSERT INTO `peer_reviews` (`id`, `project_id`, `reviewer_id`, `target_user_id`, `rating`, `comment`, `is_anonymous`, `created_at`) VALUES
(1, 1, 1, 2, 4, '엄청 잘하세요!', 0, '2025-11-22 18:28:38'),
(3, 1, 1, 8, 5, '진짜 잘하세요!', 1, '2025-11-22 18:44:29'),
(4, 1, 2, 8, 4, '굉장히 잘하세요!', 0, '2025-11-22 19:00:47');

-- --------------------------------------------------------

--
-- 테이블 구조 `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('모집중','진행중','완료') NOT NULL DEFAULT '완료',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `projects`
--

INSERT INTO `projects` (`id`, `title`, `status`, `created_at`) VALUES
(1, '완료된 데모 프로젝트', '완료', '2025-11-22 18:20:01');

-- --------------------------------------------------------

--
-- 테이블 구조 `project_members`
--

CREATE TABLE `project_members` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_role` enum('리더','팀원') NOT NULL DEFAULT '팀원',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`, `member_role`, `created_at`) VALUES
(1, 1, 1, '리더', '2025-11-22 18:20:01'),
(2, 1, 2, '팀원', '2025-11-22 18:20:01'),
(3, 1, 3, '팀원', '2025-11-22 18:20:01'),
(4, 1, 4, '팀원', '2025-11-22 18:20:01'),
(5, 1, 5, '팀원', '2025-11-22 18:20:01'),
(6, 1, 6, '팀원', '2025-11-22 18:20:01'),
(7, 1, 7, '팀원', '2025-11-22 18:20:01'),
(8, 1, 8, '팀원', '2025-11-22 18:20:01');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` enum('개발자','디자이너','기획') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `created_at`) VALUES
(1, '김진우', '개발자', '2025-11-22 18:19:52'),
(2, '임재이', '기획', '2025-11-22 18:19:52'),
(3, '김민경', '기획', '2025-11-22 18:19:52'),
(4, '김호진', '기획', '2025-11-22 18:19:52'),
(5, '박주안', '개발자', '2025-11-22 18:19:52'),
(6, '이수아', '디자이너', '2025-11-22 18:19:52'),
(7, '조태연', '디자이너', '2025-11-22 18:19:52'),
(8, '허윤선', '디자이너', '2025-11-22 18:19:52');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `peer_reviews`
--
ALTER TABLE `peer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_review_once` (`project_id`,`reviewer_id`,`target_user_id`),
  ADD KEY `fk_pr_reviewer` (`reviewer_id`),
  ADD KEY `fk_pr_target` (`target_user_id`);

--
-- 테이블의 인덱스 `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pm_project` (`project_id`),
  ADD KEY `fk_pm_user` (`user_id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `peer_reviews`
--
ALTER TABLE `peer_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- 테이블의 제약사항 `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `fk_pm_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pm_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
