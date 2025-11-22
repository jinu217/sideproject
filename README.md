📘 SideProject Platform (Tishoo) – Local Setup Guide

이 프로젝트는 XAMPP 기반 PHP + MySQL 환경에서 실행됩니다.
아래 가이드대로 진행하면 팀원 모두 동일한 환경을 구성할 수 있습니다.

⚙️ 1. 개발 환경 준비
✔️ 1-1. XAMPP 설치

https://www.apachefriends.org/download.html

PHP 8.x 포함 버전 설치

XAMPP 실행 후 Apache, MySQL 둘 다 Start

📁 2. 프로젝트 설치 경로 (중요)

프로젝트는 아래 경로에 위치해야 합니다:

C:\xampp\htdocs\sideproject\3sideproject


최종 폴더 구조 예:

htdocs
 └─ sideproject
     └─ 3sideproject
         ├─ 06_user_profile.php
         ├─ connect.php
         ├─ view/
         ├─ img/
         ├─ css/
         └─ (기타 파일들)

🌐 3. 로컬 서버 접속 URL

프로젝트 홈:

http://localhost/sideproject/3sideproject/


특정 유저 프로필 페이지 예:

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

tishoo.sql 파일 선택

Go 실행

이제 모든 테이블(users, projects, peer_reviews 등)이 자동으로 생성됩니다.

🔌 5. connect.php 환경설정

3sideproject/connect.php 내용 확인:

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

🖥️ 6. GitHub Desktop 사용법
✔️ 6-1. 설치

https://desktop.github.com/

✔️ 6-2. 저장소 Clone

GitHub Desktop 실행

File → Clone Repository

저장소 URL 입력

Local Path 반드시 아래로 설정:

C:\xampp\htdocs\sideproject\3sideproject


Clone이 완료되면 즉시 Apache가 해당 폴더를 인식하고 웹사이트가 동작합니다.

🔄 7. Pull / Commit / Push 방식
✔️ 최신 코드 받기 (Pull)

GitHub Desktop → Pull origin

✔️ 로컬 작업 후 반영하기 (Push)

변경사항 확인

Commit message 작성

Commit to main

Push origin

🌿 8. 브랜치 전략 (추천)

작업 충돌 방지를 위해 기능 단위로 브랜치를 나누세요:

feature/review-ui
feature/profile-tab
feature/project-tab
bugfix/mysql-connection


작업 후 main 브랜치로 PR을 보내 병합합니다.

🎉 9. 실행 체크리스트

 XAMPP Apache/MySQL 실행됨

 tishoo.sql 정상 import

 connect.php DB 정보 올바름

 프로젝트 경로 htdocs/sideproject/3sideproject로 정확함

 브라우저 접속 확인

 탭 이동(profile/project/portfolio/reviews) 정상 작동
