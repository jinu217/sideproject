<?php
// 00_view.php : 홈 화면 (폰 프레임 안에 들어가는 내용)
?>

<div class="div">
  <div class="div2">
    <div class="inner">
      <div class="group-parent">
        <div class="group">
          <img src="../img/logo.svg" class="logo-icon" alt="Tishoo 로고">
        </div>
        <div class="icons">
          <div class="iconsearch"></div>
          <img src="../img/bell.svg" class="iconbell" alt="알림" id="btn-notification">
          <img src="../img/align_justify.svg" class="iconbell" alt="메뉴">
        </div>
      </div>
    </div>

    <div class="frame-parent">
      <div class="frame-wrapper">
        <div class="iconsearch-parent">
          <div class="iconsearch2"></div>
          <div class="div3">프로젝트, 멘토, 태그 검색</div>
        </div>
      </div>

      <div class="frame-group">
        <div class="parent">
          <div class="div4" id="box-project-list">
            <div class="child"></div>
            <img src="../img/project_list_logo.png" class="group-1597880446-1" alt="">
            <div class="container">
              <b class="b">모집중인<br>사이드 프로젝트</b>
              <div class="content-parent">
                <div class="content">
                  <div class="left-icon"></div>
                  <div class="div5">보러가기</div>
                  <div class="left-icon"></div>
                </div>
                <img class="iconchevron-right" alt="">
              </div>
            </div>
          </div>
          <div class="wrapper">
            <div class="div6" id="box-timmate">
              <div class="div7">팀원찾기</div>
              <img src="../img/timmate_logo.svg" class="vector-parent">
            </div>
          </div>
        </div>

        <div class="div8">
          <div class="div9">
            <img src="../img/ad.png">
            <div class="ad-wrapper">
              <div class="ad">AD</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="company">
        <div class="price-wrapper">
          <div class="price">
            <div class="price-inner">
              <div class="notofire-parent">
                <img class="notofire-icon" alt="">
                <div class="frame-container">
                  <div class="frame">
                    <div class="div10">이번달 명예의 전당</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="actions-parent">
              <div class="actions">
                <div class="buttontextassistive">
                  <div class="content2">
                    <div class="actions">
                      <div class="label"> 전체보기</div>
                    </div>
                  </div>
                  <div class="interaction"></div>
                </div>
              </div>
              <img src="../img/arrow_right.svg" class="iconchevron-right2" alt="">
            </div>
          </div>
        </div>

        <div class="block-parent">
          <div class="block">
            <div class="block-inner">
              <div class="overlay-parent">
                <div class="overlay"></div>
                <div class="contents">
                  <div class="information">
                    <div class="div11">2024.11 - 2024.12</div>
                    <div class="frame-div">
                      <div class="vs-code">온라인 · 팀원 4명 · 1개월</div>
                    </div>
                  </div>
                </div>
                <div class="ai-ux">AI 기반 UX 리서치 도구</div>
              </div>
            </div>
          </div>

          <div class="block">
            <div class="block-inner">
              <div class="overlay-group">
                <div class="overlay2"></div>
                <div class="contents">
                  <div class="information">
                    <div class="div11">2024.11 - 2024.12</div>
                    <div class="frame-div">
                      <div class="vs-code">온라인 · 팀원 4명 · 1개월</div>
                    </div>
                  </div>
                </div>
                <div class="div15">
                  디자인 전공자를 위한<br>
                  포트폴리오 툴 웹 서비스 기획
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="frame-parent2">
      <div class="price-container">
        <div class="price">
          <div class="price-inner">
            <div class="notofire-parent">
              <img class="notofire-icon" alt="">
              <div class="frame-container">
                <div class="frame">
                  <div class="div10">추천 멘토</div>
                </div>
              </div>
            </div>
          </div>
          <div class="actions-parent">
            <div class="actions">
              <div class="buttontextassistive">
                <div class="content2">
                  <div class="actions">
                    <div class="label"> 전체보기</div>
                  </div>
                </div>
                <div class="interaction"></div>
              </div>
            </div>
            <img src="../img/arrow_right.svg" class="iconchevron-right2" alt="">
          </div>
        </div>
      </div>

      <!-- ✅ Hacker / Hipster / Hustler 탭 -->
      <div class="chip" id="mentor-role-tabs">
        <div class="chip2">
          <div class="text-wrapper">
            <div class="text">Hacker</div>
          </div>
        </div>
        <div class="chip3">
          <div class="text-wrapper">
            <div class="text">Hipster</div>
          </div>
        </div>
        <div class="chip4">
          <div class="text-wrapper">
            <div class="text">Hustler</div>
          </div>
        </div>
      </div>

      <!-- ✅ 멘토 카드 리스트 (JS로 렌더링) -->
      <div class="frame-parent3" id="mentor-card-list"></div>
    </div><!-- .frame-parent2 -->
  </div><!-- .div2 -->
</div><!-- .div -->

<script>
document.addEventListener("DOMContentLoaded", function () {
  // 1. 기본 네비게이션 클릭
  var projectBox = document.getElementById("box-project-list");
  if (projectBox) {
    projectBox.addEventListener("click", function () {
      window.location.href = "01_project_list.php";
    });
  }

  var timmateBox = document.getElementById("box-timmate");
  if (timmateBox) {
    timmateBox.addEventListener("click", function () {
      window.location.href = "02_timmate.php";
    });
  }

  // 2. 🔔 알림 아이콘 → 공통 모달 호출 (layout.php 의 openModal 사용)
  var notiBtn = document.getElementById("btn-notification");
  if (notiBtn && typeof openModal === "function") {
    notiBtn.addEventListener("click", function () {
      // 05_01_project_finish.php 안에서 05_01_view.php + 05_01_view.css 사용
      openModal("05_01_project_finish.php");
    });
  }

  // 3. 👇 Hacker / Hipster / Hustler 멘토 탭 스위칭
  setupMentorTabs();
});

// =========================
// 👇 멘토 탭 전용 스크립트
// =========================
function setupMentorTabs() {
  const chipContainer = document.getElementById("mentor-role-tabs");
  const mentorList    = document.getElementById("mentor-card-list");

  if (!chipContainer || !mentorList) return;

  // 탭 역할 / 라벨 정의
  const ROLES   = ["hacker", "hipster", "hustler"];
  const LABELS  = {
    hacker:  "Hacker",
    hipster: "Hipster",
    hustler: "Hustler",
  };

  // ✅ 각 역할에 대해 어떤 chip 클래스를 쓸지 정의 (디자인 그대로 유지)
  const CLASS_FOR_ROLE = {
    // active: 중앙 탭이 강조되는 기준
    hacker:  { hacker: "chip3", hipster: "chip2", hustler: "chip4" },
    hipster: { hacker: "chip2", hipster: "chip3", hustler: "chip4" },
    hustler: { hacker: "chip2", hipster: "chip4", hustler: "chip3" },
  };

  // ✅ 멘토 데이터 (Hacker / Hipster / Hustler)
  const mentorData = {
    hacker: [
      {
        name: "전재민",
        skills: ["VS Code", "HTML", "Github"],
        available: "매주 수요일 가능",
      },
      {
        name: "송슬기",
        skills: ["Notion", "Figma", "Prisma"],
        available: "매주 화요일 가능",
      },
      {
        name: "김범수",
        skills: ["Sketch", "Node", "Jest"],
        available: "매주 금요일 가능",
      },
    ],
    hipster: [
      {
        name: "이상운",
        skills: ["Figma", "Notion", "Adobe"],
        available: "매주 화요일 가능",
      },
      {
        name: "정채아",
        skills: ["Figma", "Photoshop", "Sketch"],
        available: "매주 수요일 가능",
      },
      {
        name: "박재경",
        skills: ["Illustration", "Figma", "Notion"],
        available: "매주 일요일 가능",
      },
    ],
    hustler: [
      {
        name: "곽태웅",
        skills: ["Jira", "Slack", "Exel"],
        available: "매주 목요일 가능",
      },
      {
        name: "임수민",
        skills: ["Notion", "Excel", "Tableau"],
        available: "매주 월요일 가능",
      },
      {
        name: "박재경",
        skills: ["Exel", "Jira", "Notion"],
        available: "매주 수요일 가능",
      },
    ],
  };

  // -------------------------
  // 1) 탭 UI 렌더링
  // -------------------------
  function renderTabs(activeRole) {
    const classes = CLASS_FOR_ROLE[activeRole];
    if (!classes) return;

    chipContainer.innerHTML = ROLES.map((role) => {
      const cls = classes[role]; // chip2 / chip3 / chip4
      return `
        <div class="${cls}" data-role="${role}">
          <div class="text-wrapper">
            <div class="text">${LABELS[role]}</div>
          </div>
        </div>
      `;
    }).join("");
  }

  // -------------------------
  // 2) 멘토 카드 렌더링
  // -------------------------
  function renderCards(role) {
    const list = mentorData[role] || [];
    mentorList.innerHTML = list
      .map((m) => createMentorCardHTML(m))
      .join("");
  }

  // 👉 카드 하나의 HTML 템플릿 (기존 디자인 그대로)
  function createMentorCardHTML(mentor) {
    const skillsHTML = mentor.skills
      .map((skill, idx) => {
        const dot = idx === 0 ? "" : `<div class="div18">·</div>`;
        return `
          ${dot}
          <div class="vs-code">${skill}</div>
        `;
      })
      .join("");

    return `
      <div class="frame-parent4">
        <div class="frame-parent5">
          <img class="frame-child" alt="">
          <div class="frame-parent6">
            <div class="frame-parent7">
              <div class="parent2">
                <div class="div17">${mentor.name}</div>
                <img class="frame-item" alt="">
              </div>
              <div class="vs-code-parent">
                ${skillsHTML}
              </div>
            </div>
            <div class="div20">${mentor.available}</div>
          </div>
        </div>
        <div class="icon-parent">
          <div class="icon">
            <div class="controltoggle-icon">
              <div class="icon2">
                <div class="color"></div>
              </div>
              <div class="interaction5">
                <div class="interaction6"></div>
              </div>
            </div>
          </div>
          <div class="buttonsolidprimary-wrapper">
            <div class="buttonsolidprimary">
              <div class="content2">
                <div class="actions">
                  <div class="label3">연락하기</div>
                </div>
              </div>
              <div class="interaction7">
                <div class="interaction8"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  // -------------------------
  // 3) 역할 변경 + 초기 세팅
  // -------------------------
  function setRole(role) {
    if (!ROLES.includes(role)) return;
    renderTabs(role);
    renderCards(role);
  }

  // 탭 클릭 이벤트 (이벤트 위임)
  chipContainer.addEventListener("click", function (e) {
    const pill = e.target.closest("[data-role]");
    if (!pill) return;

    const role = pill.getAttribute("data-role");
    setRole(role);
  });

  // ✅ 초기 상태: Hacker
  setRole("hacker");
}
</script>
