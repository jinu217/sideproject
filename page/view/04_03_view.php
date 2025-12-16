<!-- 04_03_new_project.php -->

<div class="page-wrap">
  <!-- 상단 헤더 -->
  <div class="div2">
    <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

    <div class="parent">
      <div class="div3">프로젝트 생성</div>
      <div class="div4">3 / 5</div>
    </div>
  </div>

  <!-- 본문 -->
  <div class="content">
    <!-- 섹션 타이틀 -->
    <div class="section-header">
      <div class="section-title">프로젝트 상세 정보</div>
    </div>

    <!-- 프로젝트 이름 -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">프로젝트 이름</span>
        <span class="field-required">*</span>
      </div>
      <div class="field-input">프로젝트 이름을 입력하세요</div>
    </div>

    <!-- 프로젝트 기간 -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">프로젝트 기간</span>
        <span class="field-required">*</span>
      </div>
      <div class="field-input">프로젝트 기간을 입력하세요</div>
    </div>

    <!-- 작업 공간 링크 -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">작업 공간 링크</span>
      </div>
      <div class="field-input">프로젝트 이름을 입력하세요</div>
    </div>

    <!-- 프로젝트 설명 -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">프로젝트 설명</span>
        <span class="field-required">*</span>
      </div>
      <div class="field-textarea">프로젝트 설명을 입력하세요</div>
    </div>

    <!-- 커버 이미지 -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">커버 이미지</span>
        <span class="field-required">*</span>
      </div>
      <div class="cover-upload">
        <div class="cover-icon"></div>
        <div class="cover-text">Click to Upload</div>
      </div>
    </div>

    <!-- 참여 방식 (단일 선택) -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">참여 방식</span>
      </div>
      <div class="chip-group chip-single">
        <div class="chip">
          <span class="chip-label">온라인</span>
        </div>
        <div class="chip">
          <span class="chip-label">오프라인</span>
        </div>
        <div class="chip">
          <span class="chip-label">하이브리드</span>
        </div>
      </div>
    </div>

    <!-- 주간 빈도 (단일 선택) -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">주간 빈도</span>
      </div>
      <div class="chip-group chip-single">
        <div class="chip">
          <span class="chip-label">주 1회</span>
        </div>
        <div class="chip">
          <span class="chip-label">주 2회</span>
        </div>
        <div class="chip">
          <span class="chip-label">주 2회 이상</span>
        </div>
      </div>
    </div>

    <!-- 요일 (복수 선택) -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">요일</span>
      </div>
      <div class="chip-group chip-multi">
        <div class="chip weekday-chip"><span class="chip-label">월</span></div>
        <div class="chip weekday-chip"><span class="chip-label">화</span></div>
        <div class="chip weekday-chip"><span class="chip-label">수</span></div>
        <div class="chip weekday-chip"><span class="chip-label">목</span></div>
        <div class="chip weekday-chip"><span class="chip-label">금</span></div>
        <div class="chip weekday-chip"><span class="chip-label">토</span></div>
        <div class="chip weekday-chip"><span class="chip-label">일</span></div>
      </div>
    </div>

    <!-- 시간대 (단일 선택) -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">시간대</span>
      </div>
      <div class="chip-group chip-single">
        <div class="chip">
          <span class="chip-label">오전</span>
        </div>
        <div class="chip">
          <span class="chip-label">오후</span>
        </div>
        <div class="chip">
          <span class="chip-label">저녁</span>
        </div>
      </div>
    </div>

    <!-- 일정 조정 가능 여부 (단일 선택 / 예·아니오) -->
    <div class="field">
      <div class="field-label-row">
        <span class="field-label">일정 조정 가능 여부</span>
        <span class="field-required">*</span>
      </div>
      <div class="chip-group chip-single schedule-group">
        <div class="chip">
          <span class="chip-label">예</span>
        </div>
        <div class="chip">
          <span class="chip-label">아니오</span>
        </div>
      </div>
    </div>
  </div>

  <!-- 하단 '다음' 버튼 -->
  <div class="div10">
    <div class="div11" id="nextBtn">
      <div class="frame-div">
        <div class="mvp">다음</div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const backIcon = document.getElementById("arrowBackIosNewIcon");
  const nextBtn  = document.getElementById("nextBtn");

  // 뒤로가기
  if (backIcon) {
    backIcon.addEventListener("click", () => {
      window.history.back();
    });
  }

  // 단일 선택 칩 그룹 (참여 방식 / 주간 빈도 / 시간대 / 일정 조정 가능 여부)
  const singleGroups = document.querySelectorAll(".chip-group.chip-single");
  singleGroups.forEach(group => {
    const chips = group.querySelectorAll(".chip");
    chips.forEach(chip => {
      chip.addEventListener("click", () => {
        chips.forEach(c => c.classList.remove("active"));
        chip.classList.add("active");

        // 일정 조정 가능 여부 그룹에서 선택되면 '다음' 활성화
        if (group.classList.contains("schedule-group") && nextBtn) {
          nextBtn.classList.add("active");
        }
      });
    });
  });

  // 요일(복수 선택)
  const weekdayChips = document.querySelectorAll(".chip-group.chip-multi .weekday-chip");
  weekdayChips.forEach(chip => {
    chip.addEventListener("click", () => {
      chip.classList.toggle("active");
    });
  });

  // 다음 버튼 클릭
  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      if (!nextBtn.classList.contains("active")) return;
      window.location.href = "04_04_new_project.php";
    });
  }
});
</script>