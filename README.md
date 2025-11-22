📘 ##SideProject Platform (Tishoo) – Local Setup Guide

이 프로젝트는 XAMPP 기반 PHP + MySQL 환경에서 실행됩니다.
아래 가이드대로 진행하면 팀원 모두 동일한 환경을 구성할 수 있습니다.

⚙️ 1. 개발 환경 준비
✔️ 1-1. XAMPP 설치

https://www.apachefriends.org/download.html

PHP 8.x 포함 버전 설치

XAMPP 실행 → Apache, MySQL 둘 다 Start

📁 2. 프로젝트 설치 경로 (중요)

프로젝트는 반드시 아래 경로에 설치해야 합니다:

C:\xampp\htdocs\sideproject\3sideproject


최종 폴더 구조 예시:

htdocs
 └─ sideproject
     └─ 3sideproject
         ├─ index.php
         ├─ 06_user_profile.php
         ├─ connect.php
         ├─ view/
         ├─ img/
         ├─ css/
         └─ 기타 PHP 파일

🌐 3. 로컬 서버 접속 주소

사이트 홈:

http://localhost/sideproject/3sideproject/


특정 유저 프로필 페이지:

http://localhost/sideproject/3sideproject/06_user_profile.php?user_id=1

🗄️ 4. 데이터베이스 Import (tishoo.sql)
✔️ 4-1. phpMyAdmin 접속
http://localhost/phpmyadmin/

✔️ 4-2. 데이터베이스 생성

좌측 상단 New

Database name → tishoo

Collation → utf8mb4_general_ci

Create 클릭

✔️ 4-3. tishoo.sql Import

상단 메뉴 Import

tishoo.sql 파일 선택 (프로젝트 공유 시 함께 제공됨)

Go 클릭

→ 모든 테이블(users, projects, peer_reviews 등) 자동 생성 완료

🔌 5. connect.php 환경 설정

3sideproject/connect.php 파일의 설정이 아래와 동일해야 합니다:

<?php
$server   = "localhost";
$user     = "root";
$password = "";
$dbname   = "tishoo";

$conn = new mysqli($server, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

🖥️ 6. GitHub Desktop로 프로젝트 받기
✔️ 6-1. 설치

https://desktop.github.com/

✔️ 6-2. Clone Repository

GitHub Desktop 실행

File → Clone Repository

저장소 URL 입력

Local Path를 반드시 아래로 설정:

C:\xampp\htdocs\sideproject\3sideproject


→ Clone 완료 후 바로 Apache가 읽어 웹사이트 동작!

🔄 7. Git 작업 흐름 (Pull / Commit / Push)
✔️ 최신 코드 받기(Pull)

GitHub Desktop → Pull origin

✔️ 내 작업 저장하기(Commit & Push)

변경 파일 확인

Commit 메시지 작성

Commit to main

Push origin

🌿 8. 브랜치 전략(팀 추천 방식)

기능 충돌 방지를 위해 브랜치를 다음처럼 나누세요:

feature/review-ui
feature/profile-tab
feature/project-tab
feature/portfolio-tab
feature/write-review
bugfix/mysql-connection


작업 후 main 브랜치로 Pull Request 후 병합합니다.

🎉 9. 실행 체크리스트

 Apache 실행

 MySQL 실행

 tishoo.sql 정상 Import

 connect.php DB 정보 확인

 프로젝트 경로 정확히 sideproject/3sideproject

 브라우저 접속 정상

 탭 이동(profile/project/portfolio/reviews) 정상 작동
