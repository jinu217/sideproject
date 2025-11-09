# 🧩 SideProject Platform MVP
> 협업 완주율을 높이기 위한 사이드프로젝트 매칭 플랫폼 (PHP + MySQL + HTML)

---

## 🚀 프로젝트 개요
이 프로젝트는 **XAMPP 환경**에서 동작하는 PHP 기반 웹 애플리케이션입니다.  
- 사용자는 **프로필 설정 / 프로젝트 생성 / 참여 / 평가** 기능을 사용할 수 있습니다.  
- UI는 HTML로 구성되어 있으며, 데이터는 MySQL DB에 저장됩니다.  

---

## ⚙️ 1. 개발 환경 세팅

### ✅ 1) 준비물 설치
1. **XAMPP 설치**
   - 다운로드: [https://www.apachefriends.org](https://www.apachefriends.org)
   - 설치 후 **Apache**와 **MySQL**을 켜주세요.

2. **GitHub Desktop 설치**
   - 다운로드: [https://desktop.github.com](https://desktop.github.com)
   - 설치 후 GitHub 계정으로 로그인합니다.

---

## 📦 2. 프로젝트 가져오기 (GitHub Desktop 사용)

### ✅ 1) GitHub Desktop 실행  
- 상단 메뉴에서 → **File → Clone Repository…** 클릭  

### ✅ 2) Repository 탭에서  
- 검색창에 `jinu217/sideproject` 입력  
- 또는 URL 직접 입력  
https://github.com/jinu217/sideproject.git

### ✅ 3) Local Path 선택  
- 경로를 아래처럼 지정해 주세요 👇  
C:\xampp\htdocs\sideproject

- **[Clone]** 버튼 클릭  

### ✅ 4) 완료 후 GitHub Desktop 확인  
왼쪽 상단에 `sideproject` 이름이 보이면 클론 성공입니다.

---

## 🧱 3. 데이터베이스 설정 (phpMyAdmin 사용)

### ✅ 1) phpMyAdmin 접속  
브라우저 주소창에 입력:
http://localhost/phpmyadmin

### ✅ 2) 새 데이터베이스 생성  
1. 좌측 상단 “**새로 만들기**” 클릭  
2. 이름 입력: `sideproject`  
3. 문자 집합: `utf8mb4_general_ci` 선택 → **생성**

### ✅ 3) SQL 파일 적용  
좌측에서 `sideproject` 데이터베이스 클릭 → 상단 “**가져오기(Import)**” 탭 클릭  

1. **파일 선택** →  
   `C:\xampp\htdocs\sideproject\db\schema.sql` 선택 → **실행**  
2. 다시 “가져오기” 탭 클릭 →  
   `C:\xampp\htdocs\sideproject\db\seed.sql` 선택 → **실행**

✅ “완료되었습니다” 메시지가 뜨면 DB 설정 성공!

---

## 💡 4. 실행 방법

1. XAMPP에서 **Apache**와 **MySQL**이 모두 켜져 있는지 확인  
2. 브라우저 주소창에 입력:
http://localhost/sideproject/index.html

3. 메인 페이지가 열리면 성공 🎉  

---

## 🧩 5. 폴더 구조

sideproject/
│
├── db/
│ ├── schema.sql # 테이블 정의
│ ├── seed.sql # 초기 데이터
│
├── api.php # 기능별 API (백엔드)
├── config.php # DB 연결 설정
├── index.html # 메인 화면 (UI)
├── .gitignore # 불필요 파일 제외
├── README.md # 설치 및 실행 가이드
└── LICENSE # 오픈소스 라이선스

---

## 🔄 6. 깃허브 협업 방법 (GitHub Desktop 기준)

### ✅ 변경사항 업로드 (Push)
1. 수정이 끝나면 GitHub Desktop으로 이동  
2. 왼쪽에 변경된 파일이 보임  
3. 아래 입력란에 메시지를 적기:
feat: update project creation UI

4. **[Commit to main]** 클릭  
5. 오른쪽 위 **[Push origin]** 클릭 → 깃허브에 업로드 완료 🎉

---

### ✅ 최신 코드 받아오기 (Pull)
1. 팀원이 업데이트했다면  
2. GitHub Desktop 상단에서 **[Fetch origin] → [Pull origin]** 클릭  
3. 자동으로 최신 버전 동기화됩니다.

---

## 🧠 7. 문제 해결 가이드

| 문제 | 원인 | 해결 방법 |
|------|------|-----------|
| `http://localhost/sideproject` 접속 안 됨 | Apache가 꺼져 있음 | XAMPP에서 Apache “Start” |
| DB 연결 에러 | DB 미생성 또는 schema.sql 미적용 | phpMyAdmin에서 다시 Import |
| GitHub push 안 됨 | Git 연결 안 됨 | 메뉴 → Repository → Repository Settings → Remote 확인 |
| 한글 깨짐 | 문자셋 문제 | DB 문자셋을 `utf8mb4_general_ci`로 변경 |

---

## 🪪 License
MIT License © 2025 Team 3조

---

## 🧩 보너스: DB를 터미널에서 직접 세팅하고 싶을 때

1. **CMD(명령 프롬프트) 열기**  
2. 아래 명령어 순서대로 입력:
```bash
mysql -u root
CREATE DATABASE sideproject CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sideproject;
SOURCE C:/xampp/htdocs/sideproject/db/schema.sql;
SOURCE C:/xampp/htdocs/sideproject/db/seed.sql;
EXIT;
브라우저에서 실행:

http://localhost/sideproject
