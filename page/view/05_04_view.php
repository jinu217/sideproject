<?php
// 05_04_view.php : 팀원 선택 화면

include_once '../connect.php';

// ----------------------
// 1) 프로젝트 ID / 리뷰어 ID 받기
// ----------------------
$project_id  = 0;
$reviewer_id = 0;

if (isset($_GET['project_id'])) {
    $project_id = (int)$_GET['project_id'];
} elseif (isset($_POST['project_id'])) {
    $project_id = (int)$_POST['project_id'];
}

if (isset($_GET['reviewer_id'])) {
    $reviewer_id = (int)$_GET['reviewer_id'];
} elseif (isset($_POST['reviewer_id'])) {
    $reviewer_id = (int)$_POST['reviewer_id'];
}

// 데모용 기본값
if ($project_id <= 0)  $project_id  = 1;
if ($reviewer_id <= 0) $reviewer_id = 1;

// ----------------------
// 2) 프로젝트 참여 인원 조회
// ----------------------
$sql = "
    SELECT 
        u.id   AS user_id,
        u.name AS user_name,
        u.role AS user_role
    FROM project_members pm
    JOIN users u ON pm.user_id = u.id
    WHERE pm.project_id = ?
    ORDER BY u.id
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}
$stmt->close();

// 2명씩 묶기
$memberRows = array_chunk($members, 2);
?>

<div class="div">
    <div class="inner">
        <div class="arrow-back-ios-new-parent">
            <!-- 뒤로가기 아이콘 -->
            <img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="arrowBackIosNewIcon">

            <div class="frame-wrapper">
                <div class="wrapper">
                    <div class="div2">팀원 후기 작성하기</div>
                </div>
            </div>

            <!-- 오른쪽 빈 아이콘(디자인 맞추기용) -->
            <div class="arrow-back-ios-icon" style="opacity:0;" alt=""></div>
        </div>
    </div>

    <div class="frame-parent">
        <div class="container">
            <div class="div3">팀원 선택하기</div>
        </div>
        <div class="frame">
            <div class="div4">후기를 남길 팀원을 선택해주세요.</div>
        </div>

        <?php if (empty($members)): ?>

            <!-- 팀원이 없을 때 -->
            <div class="frame-group">
                <div class="frame-wrapper2" style="flex:1;">
                    <div class="frame-div">
                        <div class="frame-parent2">
                            <div class="div4">이 프로젝트에 등록된 팀원이 없습니다.</div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <!-- 팀원이 있을 때: 2명씩 한 줄 -->
            <?php foreach ($memberRows as $row): ?>
                <div class="frame-group">
                    <?php foreach ($row as $m): ?>
                        <div class="frame-wrapper2">
                            <div class="frame-div member-card"
                                 data-user-id="<?= (int)$m['user_id'] ?>"
                                 data-user-name="<?= htmlspecialchars($m['user_name'], ENT_QUOTES, 'UTF-8') ?>">
                                <div class="frame-parent2">
                                    <!-- 프로필 이미지: 일단 공통 placeholder -->
                                    <img class="frame-child" src="img/default_profile.png" alt="프로필">
                                    <div class="div3">
                                        <?= htmlspecialchars($m['user_name']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (count($row) === 1): ?>
                        <!-- 팀원이 홀수인 경우 오른쪽 자리는 빈 박스로 맞춰줌 (선택 안 됨) -->
                        <div class="frame-wrapper2">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>

<script>
  var arrowBackIosNewIcon = document.getElementById("arrowBackIosNewIcon");
  if (arrowBackIosNewIcon) {
    arrowBackIosNewIcon.addEventListener("click", function (e) {
      // 필요하면 이전 단계 이동
      window.history.back();
    });
  }
  // 각 팀원 카드 클릭 시 → 후기 작성 페이지로 이동
  document.querySelectorAll('.member-card').forEach(function(card) {
      card.addEventListener('click', function () {
          const userId    = card.dataset.userId;
          const userName  = card.dataset.userName;
          const projectId = <?= (int)$project_id ?>;
          const reviewerId = <?= (int)$reviewer_id ?>;

          // 다음 화면(후기 작성 페이지)으로 이동
          const url =
              "05_05_review.php"
              + "?project_id="     + encodeURIComponent(projectId)
              + "&reviewer_id="    + encodeURIComponent(reviewerId)
              + "&target_user_id=" + encodeURIComponent(userId)
              + "&member="         + encodeURIComponent(userName);

          window.location.href = url;
      });
  });
</script>
