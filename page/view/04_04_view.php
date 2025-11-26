<div class="div">
  <div class="div2">
    <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

    <div class="parent">
      <div class="div3">프로젝트 생성</div>
      <div class="div4">4 / 5</div>
    </div>
  </div>

  <div class="div5">
    <div class="wrapper">
      <div class="div6">포지션 설정</div>
    </div>

    <div class="frame-parent">
      <div class="frame-wrapper">
        <div class="container">
          <div class="div7">모집 인원</div>
        </div>
      </div>
      <div class="frame-container">
        <div class="frame">
          <div class="div8">포지션을 선택하고 설명을 작성하세요 (최대 9명)</div>
        </div>
      </div>
    </div>

    <div class="frame-group">
      <div class="frame-div">
        <div class="wrapper2">
          <div class="div9">포지션 1</div>
        </div>
      </div>
      <div class="frame-wrapper2">
        <div class="frame-parent2">
          <div class="frame-div">
            <div class="frame-wrapper4">
              <div class="group">
                <div class="div10">포지션</div>
                <div class="div11">*</div>
              </div>
            </div>
          </div>
          <div class="frame-parent3">
            <div class="hacker-wrapper position-chip position-hacker" id="frameContainer">
              <div class="hacker">Hacker</div>
            </div>
            <div class="hipster-wrapper position-chip">
              <div class="hacker">Hipster</div>
            </div>
            <div class="hipster-wrapper position-chip">
              <div class="hacker">Hustler</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 🔽 Hacker 클릭 시 나타나는 카테고리 + 설명 영역 -->
    <div class="poscat-wrapper" id="posCat">
      <div class="poscat-frame-parent">

        <!-- 카테고리 타이틀 + 버튼 2줄 -->
        <div class="poscat-frame-wrapper">
          <div class="poscat-frame-group">
            <div class="poscat-frame-container">
              <div class="poscat-header">
                <div class="poscat-title">카테고리</div>
                <div class="poscat-sub">두 개 이상 선택</div>
              </div>
            </div>

            <div class="poscat-chip-row">
              <div class="poscat-fronted-wrapper poscat-chip">
                <div class="poscat-fronted">Fronted</div>
              </div>
              <div class="poscat-backend-wrapper poscat-chip">
                <div class="poscat-fronted">Backend</div>
              </div>
              <div class="poscat-fronted-wrapper poscat-chip">
                <div class="poscat-fronted">Full Stack</div>
              </div>
            </div>

            <div class="poscat-chip-row">
              <div class="poscat-fronted-wrapper poscat-chip">
                <div class="poscat-fronted">IOS</div>
              </div>
              <div class="poscat-fronted-wrapper poscat-chip">
                <div class="poscat-fronted">Android</div>
              </div>
              <div class="poscat-backend-wrapper poscat-chip">
                <div class="poscat-fronted">etc</div>
              </div>
            </div>
          </div>
        </div>

        <!-- 설명 영역 -->
        <div class="poscat-desc-wrapper">
          <div class="poscat-desc-box">
            <div class="poscat-desc-placeholder">설명</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 🔼 카테고리 + 설명 영역 끝 -->

    <!-- 🔽 추가 버튼 -->
    <div class="div12">
      <div class="div13" id="addButton">
        <div class="wrapper3">
          <div class="div14">추가</div>
        </div>
      </div>
    </div>
    <!-- 🔼 추가 버튼 끝 -->
  </div>

  <div class="child"></div>

  <!-- 🔽 다음 버튼 (id 추가) -->
  <div class="div15">
    <div class="div16" id="nextButton">
      <div class="wrapper4">
        <div class="div14">다음</div>
      </div>
    </div>
  </div>
  <!-- 🔼 다음 버튼 끝 -->
</div>

<script>
  var arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
  if (arrowBackIosNewIcon) {
    arrowBackIosNewIcon.addEventListener("click", function (e) {
      window.history.back();
    });
  }

  // 포지션 칩들 (Hacker / Hipster / Hustler)
  const posChips = document.querySelectorAll(".position-chip");
  const hackerChip = document.getElementById("frameContainer");
  const posCat = document.getElementById("posCat");

  // 추가 / 다음 버튼 엘리먼트
  const addButton = document.getElementById("addButton");
  const nextButton = document.getElementById("nextButton");

  // 처음엔 카테고리 + 설명 영역 숨김
  if (posCat) {
    posCat.style.display = "none";
  }

  // 🔁 추가 / 다음 버튼 상태 업데이트 함수
  function updateButtonStates() {
    const activeCount = document.querySelectorAll(".poscat-chip.active").length;

    // 추가 버튼
    if (addButton) {
      if (activeCount >= 2) {
        addButton.classList.add("add-active");
      } else {
        addButton.classList.remove("add-active");
      }
    }

    // 다음 버튼
    if (nextButton) {
      if (activeCount >= 2) {
        nextButton.classList.add("next-active");
      } else {
        nextButton.classList.remove("next-active");
      }
    }
  }

  // 포지션 클릭 로직
  posChips.forEach(chip => {
    chip.addEventListener("click", () => {
      // 포지션 모두 비활성
      posChips.forEach(c => c.classList.remove("active"));
      chip.classList.add("active");

      // Hacker 선택 시에만 카테고리 + 설명 보이기
      if (chip === hackerChip) {
        if (posCat) posCat.style.display = "flex";
      } else {
        if (posCat) posCat.style.display = "none";
      }

      // 포지션 바뀔 때 카테고리 선택 초기화
      const posCatChips = document.querySelectorAll(".poscat-chip");
      posCatChips.forEach(c => c.classList.remove("active"));

      // 버튼 상태 초기화
      updateButtonStates();
    });
  });

  // 카테고리 칩 (여러 개 선택 가능)
  const posCatChips = document.querySelectorAll(".poscat-chip");
  posCatChips.forEach(chip => {
    chip.addEventListener("click", () => {
      chip.classList.toggle("active");
      updateButtonStates();
    });
  });

  // 추가 버튼 클릭 (활성 상태에서만 동작)
  if (addButton) {
    addButton.addEventListener("click", () => {
      if (!addButton.classList.contains("add-active")) return;
      // TODO: 실제 '포지션 추가' 로직 넣기
      console.log("포지션 추가 실행");
    });
  }

  // 다음 버튼 클릭 (활성 상태에서만 동작)
  if (nextButton) {
    nextButton.addEventListener("click", () => {
      if (!nextButton.classList.contains("next-active")) return;

      window.location.href = "04_05_new_project.php";
    });
  }

  // 초기 상태 한 번 체크
  updateButtonStates();
</script>
