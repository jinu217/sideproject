<?php
// 05_01_view.php : 프로젝트 정리 알림 모달 내용
?>

<div class="notification-page">
  <div class="notification-group-parent">
    <div class="notification-group-container">
      <img src="../img/finish_logo.svg" class="notification-vector-parent">
    </div>

    <div class="notification-preview-parent">
      <b class="notification-preview">프로젝트가 무사히 끝났어요!</b>
      <div class="notification-preview2">
        팀프로젝트가 성공적으로 마무리 됐어요.<br>
        프로젝트 정리를 도와드릴까요?
      </div>
    </div>

    <div class="notification-buttons-parent">
      <div class="notification-buttons" id="btn-noti-later">
        <b class="notification-button">나중에 다시 정리 할게요</b>
      </div>
      <div class="notification-buttons2" id="btn-noti-organize">
        <b class="notification-button">프로젝트 정리하기</b>
      </div>
    </div>
  </div>
</div>

<script>
// 05_01_view.php 전용 스크립트
// 이 페이지는 iframe 안에서 열리므로, 부모의 closeModal() 을 호출

document.addEventListener("DOMContentLoaded", function () {
  var btnLater    = document.getElementById("btn-noti-later");
  var btnOrganize = document.getElementById("btn-noti-organize");

  // "나중에 다시 정리 할게요" -> 모달만 닫기
  if (btnLater && window.parent && typeof window.parent.closeModal === "function") {
    btnLater.addEventListener("click", function () {
      window.parent.closeModal();
    });
  }

  // "프로젝트 정리하기" -> 부모 페이지 이동 + 모달 닫기
  if (btnOrganize && window.parent) {
    btnOrganize.addEventListener("click", function () {
      // 필요에 따라 이동 페이지 수정
      window.parent.location.href = "05_02_project_finish.php";

      if (typeof window.parent.closeModal === "function") {
        window.parent.closeModal();
      }
    });
  }
});
</script>
