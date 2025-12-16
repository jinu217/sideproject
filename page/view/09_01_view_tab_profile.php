<?php
// /tishoo/page/view/06_01_view_tab_profile.php
?>

<div class="profile-tab-profile">
  	  	<div class="frame-parent">
    		<div class="parent">
      			<div class="div">소개</div>
      			<div class="div2">백엔드 개발로 취업을 희망하는 취준생입니다.<br>저와 함께 열정적으로 프로젝트를 진행할 팀원을 찾고 있습니다!</div>
    		</div>
    		<div class="frame-group">
      			<div class="group">
        				<div class="div3">주요 역량 뱃지</div>
        				<div class="actions-parent">
          					<div class="actions">
            						<div class="buttontextassistive">
            						</div>
          					</div>
          					<div class="iconchevron-right">
          					</div>
        				</div>
      			</div>
      			<div class="frame-container">
        				<div class="frame-wrapper badge">
          					<div class="group-parent">
            						<img src="../img/badge1.svg" class="frame-child" alt="">
            						
            						<div class="wrapper">
              							<div class="div4">완주 메이커</div>
            						</div>
          					</div>
        				</div>
        				<div class="frame-wrapper badge">
          					<div class="group-parent">
            						<img src="../img/badge2.svg" class="frame-child" alt="">
            						
            						<div class="wrapper">
              							<div class="div4">위기 해결사</div>
            						</div>
          					</div>
        				</div>
        				<div class="frame-wrapper badge">
          					<div class="group-parent">
            						<img src="../img/badge3.svg" class="frame-child" alt="">
            						
            						<div class="wrapper">
              							<div class="div4">디테일 장인</div>
            						</div>
          					</div>
        				</div>
      			</div>
    		</div>
    		<div class="frame-parent2">
      			<div class="group">
        				<div class="div3">경력사항</div>
        				<div class="actions-parent">
          					<div class="actions">
            						<div class="buttontextassistive">
            						</div>
          					</div>
          					<div class="iconchevron-right">
          					</div>
        				</div>
      			</div>
      			<div class="group-parent3">
        				<div class="group-div">
          					<div class="group-child2">
          					</div>
          					<div class="parent3">
            						<div class="div8">2024. 6 ~ 2024. 12</div>
            						<div class="div9">티슈 인턴 | 대한민국</div>
            						<div class="div10">사용자 리서치, 프로토타이핑, 디자인 시스템 구축</div>
          					</div>
        				</div>
        				<div class="frame-parent3">
          					<div class="parent4">
            						<div class="div8">2023. 3 ~ 2023. 8</div>
            						<div class="div9">동서식품 서포터즈 | 대한민국</div>
          					</div>
          					<div class="sns">SNS 컨텐츠 제작</div>
        				</div>
      			</div>
    		</div>
    		<div class="frame-parent4">
      			<div class="group">
        				<div class="div3">보유 기술</div>
        				<div class="actions-parent">
          					<div class="actions">
            						<div class="buttontextassistive">
            						</div>
          					</div>
          					<div class="iconchevron-right">
          					</div>
        				</div>
      			</div>
      			<div class="chipxs-parent">
        				<div class="chipxs">
          					<div class="text">Figma</div>
        				</div>
        				<div class="chipxs2">
          					<div class="text">Notion</div>
        				</div>
        				<div class="chipxs3">
          					<div class="text">Illustrator</div>
        				</div>
        				<div class="chipxs4">
          					<div class="text">Photoshop</div>
        				</div>
      			</div>
    		</div>
    		<div class="frame-parent5">
      			<div class="group">
        				<div class="div3">관심사 </div>
        				<div class="actions-parent">
          					<div class="actions">
            						<div class="buttontextassistive">
            						</div>
          					</div>
          					<div class="iconchevron-right">
          					</div>
        				</div>
      			</div>
      			<div class="chipxs-group">
        				<div class="chipxs5">
          					<div class="text">그림</div>
        				</div>
        				<div class="chipxs5">
          					<div class="text">네트워킹</div>
        				</div>
        				<div class="chipxs5">
          					<div class="text">지적 성장</div>
        				</div>
        				<div class="chipxs5">
          					<div class="text">IT</div>
        				</div>
        				<div class="chipxs5">
          					<div class="text">가치구현</div>
        				</div>
      			</div>
    		</div>
    		<img src="../img/line.svg" class="frame-item" alt="">
    		
  	</div>
</div>

<script>
    var badges = document.querySelectorAll(".badge");
    badges.forEach(function (badge) {
        badge.addEventListener("click", function (e) {
            window.location.href = "10_badge.php";
        });
    });
</script>