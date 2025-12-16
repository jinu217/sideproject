<!-- 04_04_new_project.php -->

<div class="page-wrap">
  <!-- 상단 헤더 -->
  <div class="div2">
    <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

    <div class="parent">
      <div class="div3">프로젝트 생성</div>
      <div class="div4">4 / 5</div>
    </div>
  </div>

  <!-- 본문 -->
  <div class="content">
    <!-- 섹션 타이틀 -->
    <div class="section-header">
      <div class="section-title">포지션 설정</div>
    </div>

    <!-- 안내 문구 -->
    <div class="info-box">
      <div class="info-title">모집 인원</div>
      <div class="info-desc">포지션을 선택하고 설명을 작성하세요 (최대 9명)</div>
    </div>

    <!-- 포지션 1 블록 -->
    <div class="position-block">
      <div class="position-title">포지션 1</div>

      <div class="field">
        <div class="field-label-row">
          <span class="field-label">포지션</span>
          <span class="field-required">*</span>
        </div>

        <!-- 🔵 포지션 칩 -->
        <div class="chip-group chip-single position-group">
          <div class="chip position-chip position-hacker" id="hackerChip">
            <span class="chip-label">Hacker</span>
          </div>
          <div class="chip position-chip">
            <span class="chip-label">Hipster</span>
          </div>
          <div class="chip position-chip">
            <span class="chip-label">Hustler</span>
          </div>
        </div>
      </div>
    </div>

    <!-- 🔵 Hacker 선택 시 나오는 카테고리 + 설명 -->
    <div class="poscat-wrapper" id="posCat">
      <div class="poscat-inner">

        <!-- ✅ 포지션과 동일한 구조: label + chip-group -->
        <div class="field">
          <div class="field-label-row poscat-header">
            <span class="field-label">카테고리</span>
            <span class="poscat-sub">두 개 이상 선택</span>
          </div>

          <!-- 1줄: Frontend / Backend / Full Stack -->
          <div class="chip-group chip-multi poscat-group">
            <div class="chip poscat-chip">
              <span class="chip-label">Frontend</span>
            </div>
            <div class="chip poscat-chip">
              <span class="chip-label">Backend</span>
            </div>
            <div class="chip poscat-chip">
              <span class="chip-label">Full Stack</span>
            </div>
          </div>

          <!-- 2줄: iOS / Android / etc -->
          <div class="chip-group chip-multi poscat-group">
            <div class="chip poscat-chip">
              <span class="chip-label">iOS</span>
            </div>
            <div class="chip poscat-chip">
              <span class="chip-label">Android</span>
            </div>
            <div class="chip poscat-chip">
              <span class="chip-label">etc</span>
            </div>
          </div>
        </div>

        <!-- 설명 영역 -->
        <div class="field poscat-desc-field">
          <div class="field-textarea poscat-desc-box">
            설명
          </div>
        </div>
      </div>
    </div>

    <!-- 추가 버튼 -->
    <div class="add-wrap">
      <button class="add-btn" id="addButton">추가</button>
    </div>
  </div>

  <!-- 하단 다음 버튼 -->
  <div class="div10">
    <div class="div11" id="nextButton">
      <div class="frame-div">
        <div class="mvp">다음</div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const backIcon    = document.getElementById("arrowBackIosNewIcon");
  const posCat      = document.getElementById("posCat");
  const hackerChip  = document.getElementById("hackerChip");

  const posChips    = document.querySelectorAll(".position-chip");
  const posCatChips = document.querySelectorAll(".poscat-chip");

  const addButton   = document.getElementById("addButton");
  const nextButton  = document.getElementById("nextButton");

  // 뒤로가기
  if (backIcon) {
    backIcon.addEventListener("click", () => {
      window.history.back();
    });
  }

  // 버튼 상태 업데이트
  function updateButtonStates() {
    const activeCount = document.querySelectorAll(".poscat-chip.active").length;

    if (addButton) {
      if (activeCount >= 2) {
        addButton.classList.add("add-active");
      } else {
        addButton.classList.remove("add-active");
      }
    }

    if (nextButton) {
      if (activeCount >= 2) {
        nextButton.classList.add("active");
      } else {
        nextButton.classList.remove("active");
      }
    }
  }

  // 처음엔 카테고리 + 설명 숨김
  if (posCat) {
    posCat.style.display = "none";
  }

  // 포지션 클릭
  posChips.forEach(chip => {
    chip.addEventListener("click", () => {
      posChips.forEach(c => c.classList.remove("active"));
      chip.classList.add("active");

      // Hacker일 때만 카테고리/설명 노출
      if (chip === hackerChip) {
        if (posCat) posCat.style.display = "block";
      } else {
        if (posCat) posCat.style.display = "none";
      }

      // 포지션 바뀌면 카테고리 선택 초기화
      posCatChips.forEach(c => c.classList.remove("active"));
      updateButtonStates();
    });
  });

  // 카테고리 칩 (복수 선택)
  posCatChips.forEach(chip => {
    chip.addEventListener("click", () => {
      chip.classList.toggle("active");
      updateButtonStates();
    });
  });

  // 추가 버튼
  if (addButton) {
    addButton.addEventListener("click", () => {
      if (!addButton.classList.contains("add-active")) return;
      console.log("포지션 추가 실행");
    });
  }

  // 다음 버튼
  if (nextButton) {
    nextButton.addEventListener("click", () => {
      if (!nextButton.classList.contains("active")) return;
      window.location.href = "04_05_new_project.php";
    });
  }

  updateButtonStates();
});
</script>
