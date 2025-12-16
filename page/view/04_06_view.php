<!-- 05_01_project_finish.php (예시 이름) -->

<div class="page-wrap finish-page">
  <!-- 가운데 내용 -->
  <div class="finish-body">
    <div class="group-parent">
      <img src="../img/finish_logo.svg" class="frame-child" alt="완료 로고">
      
      <div class="preview-parent">
        <b class="preview">해냈어요!</b>
        <div class="preview2">당신만의 공간이 완성됐어요.</div>
      </div>

      <div class="preview3">
        이제 당신의 프로젝트예요.<br>
        크루를 초대하고 미션을 정해<br>
        직접 멋진 결과를 만들어보세요.
      </div>
    </div>
  </div>

  <!-- 하단 버튼 -->
  <div class="div10">
    <div class="div11" id="inviteButton">
      <div class="frame-div">
        <div class="mvp">함께할 크루를 초대해요</div>
      </div>
    </div>
  </div>
</div>

<script>
  const inviteButton = document.getElementById("inviteButton");

  if (inviteButton) {
    inviteButton.addEventListener("click", () => {
      window.location.href = "06_teammate.php";
    });
  }
</script>
