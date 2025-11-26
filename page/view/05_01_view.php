<?php
// 05_01_view.php : 프로젝트 정리 알림 모달 내용

// 이 모달은 반드시 ?project_id=1 이런 식으로 열려야 함.
// ex) openModal('05_01_project_finish.php?project_id=1');
$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;

// 데모용: project_id 없으면 1로
if ($project_id <= 0) {
    $project_id = 1;
}
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

  // "프로젝트 정리하기" -> 05_02로 이동하면서 project_id 전달 + 모달 닫기
  if (btnOrganize && window.parent) {
    btnOrganize.addEventListener("click", function () {
      const projectId = <?= (int)$project_id ?>;
      window.parent.location.href = "05_02_project_finish.php?project_id=" + encodeURIComponent(projectId);

      if (typeof window.parent.closeModal === "function") {
        window.parent.closeModal();
      }
    });
  }
});
</script>
