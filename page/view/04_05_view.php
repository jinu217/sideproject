<!-- 04_05_new_project.php -->

<div class="page-wrap">
  <!-- 상단 헤더 -->
  <div class="div2">
    <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

    <div class="parent">
      <div class="div3">프로젝트 생성</div>
      <div class="div4">5 / 5</div>
    </div>
  </div>

  <!-- 본문 -->
  <div class="content">
    <!-- 섹션 타이틀 -->
    <div class="section-header">
      <div class="section-title">수익 분배는 어떻게 하나요?</div>
    </div>

    <!-- 안내 문구 (필요 없으면 삭제해도 됨) -->
    <!--
    <div class="info-box">
      <div class="info-desc">프로젝트 수익을 어떻게 나눌지 선택해주세요.</div>
    </div>
    -->

    <!-- 옵션 카드 리스트 -->
    <div class="option-group">
      <div class="dist-card dist-option">
        <div class="dist-title">크리 슬라이스</div>
        <div class="dist-desc">한 판의 피자, 모두에게 똑같은 한 조각!</div>
      </div>

      <div class="dist-card dist-option">
        <div class="dist-title">주사위 굴리기</div>
        <div class="dist-desc">때로는 운명에 맡겨보세요.</div>
      </div>

      <div class="dist-card dist-option">
        <div class="dist-title">공정 분배</div>
        <div class="dist-desc">넣은 만큼, 가져가는 만큼</div>
      </div>

      <div class="dist-card dist-option">
        <div class="dist-title">크리 서클</div>
        <div class="dist-desc">모두의 목소리가 하나의 결정으로!</div>
      </div>
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
  const distOptions = document.querySelectorAll(".dist-option");
  const nextButton  = document.getElementById("nextButton");

  // 뒤로가기
  if (backIcon) {
    backIcon.addEventListener("click", () => {
      window.history.back();
    });
  }

  // 옵션 클릭 시: 하나만 선택(active) + 다음 버튼 활성화
  distOptions.forEach(option => {
    option.addEventListener("click", () => {
      // 모두 비활성화
      distOptions.forEach(o => o.classList.remove("active"));
      // 현재 카드만 활성화
      option.classList.add("active");

      // 다음 버튼 활성화 (04_01, 04_02, 04_04와 동일하게 .active 사용)
      if (nextButton) {
        nextButton.classList.add("active");
      }
    });
  });

  // 다음 버튼 클릭: 활성화 상태일 때만 동작
  if (nextButton) {
    nextButton.addEventListener("click", () => {
      if (!nextButton.classList.contains("active")) return;
      window.location.href = "04_06_new_project.php";
    });
  }
});
</script>
