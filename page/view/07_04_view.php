<?php
// 07_03_review_done.php : 팀원 후기 작성 완료 화면

include_once '../connect.php';

// 1) 필수 파라미터 (GET)
$project_id     = isset($_GET['project_id'])     ? (int)$_GET['project_id']     : 0;
$target_user_id = isset($_GET['target_user_id']) ? (int)$_GET['target_user_id'] : 0;
$reviewer_id    = isset($_GET['reviewer_id'])    ? (int)$_GET['reviewer_id']    : 0;

if ($project_id <= 0 || $target_user_id <= 0 || $reviewer_id <= 0) {
    echo "<div style='padding:20px;font-family:Pretendard;'>잘못된 접근입니다. (project_id / target_user_id / reviewer_id 필요)</div>";
    exit;
}

// 2) 방금 작성한 리뷰(또는 가장 최신 리뷰) 가져오기
$sql = "
    SELECT 
        pr.rating,
        pr.keywords,
        pr.comment,
        u.name       AS target_name,
        u.role       AS target_role,
        up.profile_image_url
    FROM peer_reviews pr
    JOIN users u ON pr.target_user_id = u.id
    LEFT JOIN user_profiles up ON up.user_id = u.id
    WHERE 
        pr.project_id     = ?
        AND pr.target_user_id = ?
        AND pr.reviewer_id    = ?
    ORDER BY pr.created_at DESC
    LIMIT 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $project_id, $target_user_id, $reviewer_id);
$stmt->execute();
$res = $stmt->get_result();
$review = $res->fetch_assoc();
$stmt->close();

if (!$review) {
    echo "<div style='padding:20px;font-family:Pretendard;'>해당 조건의 후기를 찾을 수 없습니다.</div>";
    exit;
}

$targetName  = $review['target_name'] ?? '알 수 없음';
$targetRole  = $review['target_role'] ?? '';
$rating      = (int)($review['rating'] ?? 0);
$keywordsStr = $review['keywords'] ?? '';
$keywords    = [];

// ✅ 프로필 이미지 (없으면 기본 이미지)
$targetProfileImage = !empty($review['profile_image_url'])
    ? $review['profile_image_url']
    : '../img/default_profile.png';

// keywords가 "소통이 잘돼요,책임감 있어요" 이런 형태로 저장된 경우
if ($keywordsStr !== '') {
    $keywords = array_map('trim', explode(',', $keywordsStr));
}
?>
  	<div class="app">
    		<div class="app-inner">
      			<div class="arrow-back-ios-new-parent">
        				<img src="../img/arrow_left.svg" class="arrow-back-ios-new-icon" alt="" id="backArrow">
        				
        				<div class="frame-wrapper">
          					<div class="wrapper">
            						<div class="div">팀원 후기 작성완료</div>
          					</div>
        				</div>
        				<!-- 오른쪽 더미 아이콘 -->
        				<img class="arrow-back-ios-new-icon" alt="">
      			</div>
    		</div>

    		<div class="container-parent">
      			<div class="container">
        				<div class="container-icon" alt="">
							<img src="../img/check_circle.svg" >
						</div>
        				<div class="heading-1">
          					<b class="b">후기 작성 완료!</b>
        				</div>
      			</div>

      			<div class="container-wrapper">
        				<div class="container2">
          					<div class="container-group">
            						<div class="container3" id="user-profile">
              							<div class="container-container">
                								<div class="container4">
                  									<!-- ✅ DB 연동 프로필 이미지 -->
                  									<img
                                                        class="container-icon2"
                                                        src="<?= htmlspecialchars($targetProfileImage, ENT_QUOTES, 'UTF-8') ?>"
                                                        alt="profile">
                								</div>
                								<div class="heading-2-parent">
                  									<div class="heading-2">
                    										<b class="b2"><?= htmlspecialchars($targetName) ?></b>
                  									</div>
                  									<div class="paragraph">
                    										<b class="uxui"><?= htmlspecialchars($targetRole ?: '팀원') ?></b>
                  									</div>
                								</div>
              							</div>
            						</div>

            						<!-- 협업 만족도 / 별점 -->
            						<div class="frame-parent">
              							<div class="frame">
                								<div class="div2">협업 만족도</div>
              							</div>
              							<div class="component-24">
                								<?php for ($i = 1; $i <= 5; $i++): ?>
                									<img 
                                                        class="component-24-child" 
                                                        src="<?= ($i <= $rating) ? '../img/star_on.svg' : '../img/star_off.svg' ?>" 
                                                        alt="star <?= $i ?>">
                								<?php endfor; ?>
              							</div>
            						</div>

            						<!-- 어떤 점이 좋았나요? (선택된 키워드만 버튼으로 표시) -->
            						<div class="frame-group">
              							<div class="frame">
                								<div class="div2">어떤 점이 좋았나요?</div>
              							</div>
              							<div class="component-18-parent">
                								<?php if (!empty($keywords)): ?>
                    								<?php foreach ($keywords as $kw): ?>
                        								<div class="component-18">
                          									<div class="text"><?= htmlspecialchars($kw) ?></div>
                        								</div>
                    								<?php endforeach; ?>
                								<?php else: ?>
                    								<!-- 키워드를 선택 안 했을 경우 -->
                    								<div style="font-size:0.875rem;color:#6a7282;">
                        									선택한 키워드가 없습니다.
                    								</div>
                								<?php endif; ?>
              							</div>
            						</div>
          					</div>
        				</div>
      			</div>
    		</div>
  	</div>

  	<div id="container" class="popup-overlay">
    		<div class="div5">
      			<img class="child" src="../img/star_on.svg" alt="">
      			<img class="child" src="../img/star_on.svg" alt="">
      			<img class="child" src="../img/star_on.svg" alt="">
      			<img class="child" src="../img/star_on.svg" alt="">
      			<img class="child" src="../img/star_on.svg" alt="">
    		</div>
  	</div>
  	
  	<script>
        // 뒤로가기 : 팀원 선택 화면으로 되돌아가기
        var backArrow = document.getElementById("backArrow");
        if (backArrow) {
            backArrow.addEventListener("click", function () {
                window.history.back();
            });
        }

	    var user_profile = document.getElementById("user-profile");
		if (user_profile) {
			user_profile.addEventListener("click", function () {
				window.location.href = "09_user_profile.php?user=<?= (int)$target_user_id ?>";
			});
		}

  	</script>
