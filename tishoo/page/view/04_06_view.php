<div class="div">
  <div class="group-parent">
    <img class="frame-child" alt="">
    
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

  <div class="div2">
    <!-- 버튼 -->
    <div class="div3" id="inviteButton">
      <div class="wrapper">
        <div class="div4">함께할 크루를 초대해요</div>
      </div>
    </div>
  </div>
</div>

<script>
  const inviteButton = document.getElementById("inviteButton");

  if (inviteButton) {
    inviteButton.addEventListener("click", () => {
      window.location.href = "02_timmate.php";
    });
  }
</script>
