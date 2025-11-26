<div class="div">
  <div class="div2">
    <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">
    
    <div class="parent">
      <div class="div3">프로젝트 생성</div>
      <div class="div4">5 / 5</div>
    </div>
  </div>

  <div class="div5">
    <div class="group">
      <div class="div6">수익 분배는 어떻게 하나요?</div>

      <div class="frame-parent">
        <!-- 각 카드에 dist-option 클래스 추가 -->
        <div class="container dist-option">
          <div class="div7">크리 슬라이스</div>
          <div class="div8">한 판의 피자, 모두에게 똑같은 한 조각!</div>
        </div>
        <div class="container dist-option">
          <div class="div7">주사위 굴리기</div>
          <div class="div8">때로는 운명에 맡겨보세요.</div>
        </div>
        <div class="parent2 dist-option" id="frameContainer2">
          <div class="div7">공정 분배</div>
          <div class="div8">넣은 만큼, 가져가는 만큼</div>
        </div>
        <div class="container dist-option">
          <div class="div7">크리 서클</div>
          <div class="div8">모두의 목소리가 하나의 결정으로!</div>
        </div>
      </div>
    </div>
  </div>

  <div class="child"></div>

  <div class="div15">
    <!-- 다음 버튼에 id 추가 -->
    <div class="div16" id="nextButton">
      <div class="wrapper">
        <div class="div17">다음</div>
      </div>
    </div>
  </div>
</div>

<script>
  // 뒤로가기
  const arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
  if (arrowBackIosNewIcon) {
    arrowBackIosNewIcon.addEventListener("click", function (e) {
      // 필요하면 여기서 이전 단계 이동
      window.history.back();
    });
  }

  // 수익 분배 옵션 카드들
  const distOptions = document.querySelectorAll(".dist-option");
  const nextButton = document.getElementById("nextButton");

  // 옵션 클릭 시: 하나만 선택(active) + 다음 버튼 활성화
  distOptions.forEach(option => {
    option.addEventListener("click", () => {
      // 모두 비활성화
      distOptions.forEach(o => o.classList.remove("active"));
      // 현재 카드만 활성화
      option.classList.add("active");

      // 다음 버튼 활성화
      if (nextButton) {
        nextButton.classList.add("next-active");
      }
    });
  });

  // 다음 버튼 클릭: 활성화 상태일 때만 동작
  if (nextButton) {
    nextButton.addEventListener("click", () => {
      if (!nextButton.classList.contains("next-active")) return;

      window.location.href = "04_06_new_project.php";
    });
  }
</script>
