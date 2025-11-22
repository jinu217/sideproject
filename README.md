###📘 SideProject Platform (Tishoo) – Local Setup Guide

팀원이 그대로 따라 하면 100% 실행되게 최대한 쉽게 작성했어!

##⚙️ 1. 개발 환경 세팅
#✔️ 1-1. XAMPP 설치

https://www.apachefriends.org/download.html

PHP 8.x 포함 버전 설치

XAMPP 실행 → Apache, MySQL 둘 다 Start

##📁 2. 프로젝트 설치 위치(중요)

프로젝트는 다음 위치에 넣어야 정상 작동함:

C:\xampp\htdocs\sideproject\3sideproject


폴더 구조 예:

htdocs
 └─ sideproject
     └─ 3sideproject
         ├─ 06_user_profile.php
         ├─ connect.php
         ├─ view/
         ├─ img/
         ├─ css/
         └─ (기타 파일들)

##🌐 3. 웹사이트 접속 주소

브라우저 주소창에 입력:

http://localhost/sideproject/3sideproject/


특정 유저 프로필 케이스:

http://localhost/sideproject/3sideproject/06_user_profile.php?user_id=1

##🗄️ 4. DB 설치 (tishoo.sql import)
#✔️ 4-1. phpMyAdmin 접속

브라우저에서:

http://localhost/phpmyadmin/

#✔️ 4-2. DB 만들기

New → Database name: tishoo

Collation: utf8mb4_general_ci

Create

#✔️ 4-3. tishoo.sql import

상단 Import 클릭

tishoo.sql 선택

Go 실행

👉 모든 테이블(users, projects, peer_reviews 등)이 자동 생성됨.

##🔌 5. connect.php 설정

3sideproject/connect.php 파일 확인:

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

##🖥️ 6. GitHub Desktop 사용법

팀원들이 로컬에서 개발하려면 GitHub Desktop이 훨씬 쉬움.

#✔️ 6-1. GitHub Desktop 다운로드

https://desktop.github.com/

#✔️ 6-2. Clone repository

GitHub Desktop 실행

File → Clone Repository

URL 탭에서 저장소 주소 입력

Local Path를 정확히 이렇게 설정:

C:\xampp\htdocs\sideproject\3sideproject


👉 Clone 후 즉시 Apache가 해당 폴더를 읽어 바로 작동함.

##🔄 7. 변경사항 Pull / Push
✔️ 최신 코드 받기(Pull)

GitHub Desktop → Pull origin

✔️ 변경 반영(Push)

변경 확인 → Commit message 작성

Commit to main (또는 브랜치)

Push origin

##👥 8. 팀원 개발 프로세스 추천

항상 Pull → 작업 → Commit → Push

충돌 방지를 위해 기능별 브랜치 사용:

feature/review-ui
feature/project-tab
bugfix/db-error


완성 후 main 브랜치로 PR(Merge Request) 진행

##🎉 9. 프로젝트 실행 확인 체크리스트

 XAMPP Apache / MySQL 실행됨

 tishoo DB import 완료

 connect.php DB 정보 세팅됨

 경로가 htdocs/sideproject/3sideproject

 브라우저에서 정상 접속됨

 탭 전환(profile/project/portfolio/reviews) 정상 작동
