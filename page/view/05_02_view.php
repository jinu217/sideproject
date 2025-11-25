  	<div class="div">
    		<div class="inner">
      			<div class="arrow-back-ios-new-parent">
        				<img class="arrow-back-ios-new-icon" alt="">
        				
        				<div class="frame-wrapper">
          					<div class="wrapper">
            						<div class="div2">프로젝트 정리하기</div>
          					</div>
        				</div>
        				<img class="arrow-back-ios-new-icon" alt="">
        				
      			</div>
    		</div>
    		<div class="child">
      			<div class="frame-parent">
        				<div class="parent">
          					<div class="div3">프로젝트 기간</div>
          					<div class="container">
            						<div class="ux-ui">2025.10 ~ 2025. 11</div>
          					</div>
        				</div>
        				<div class="parent">
          					<div class="div3">참여 팀원</div>
          					<div class="container">
            						<div class="ux-ui">6명</div>
          					</div>
        				</div>
        				<div class="parent">
          					<div class="div3">최종 산출물 </div>
          					<div class="container">
            						<div class="ux-ui">UX기획, UI디자인</div>
          					</div>
        				</div>
      			</div>
    		</div>
    		<div class="frame-group">
      			<div class="wrapper2">
        				<div class="ux-ui">파일 업로드</div>
      			</div>
      			<div class="wrapper3">
        				<div class="ux-ui">파일을 업로드하세요</div>
      			</div>
    		</div>
    		<div class="frame-group">
      			<div class="wrapper2">
        				<div class="ux-ui">간단한 설명(선택)</div>
      			</div>
      			<div class="wrapper5">
        				<div class="div11">예: 프로토타입 최종본입니다. 주요 플로우까지 포함되어 있어요.</div>
      			</div>
    		</div>
    		<div class="frame-parent2">
      			<div class="buttons-wrapper" id="frameContainer">
        				<div class="buttons">
          					<b class="button">나중에 다시 정리 할게요</b>
        				</div>
      			</div>
      			<div class="buttons-container" id="frameContainer1">
        				<div class="buttons2">
          					<b class="button">저장하기</b>
        				</div>
      			</div>
    		</div>
  	</div>
  	
  	
  	
  	
  	<script>
    		var frameContainer = document.getElementById("frameContainer");
    		if(frameContainer) {
      			frameContainer.addEventListener("click", function (e) {
        				// Add your code here
      			});
    		}
    		
    		var frameContainer1 = document.getElementById("frameContainer1");
			if(frameContainer1) {
				frameContainer1.addEventListener("click", function (e) {
					// 🔥 저장하기 클릭 → 페이지 이동
					window.location.href = "05_03_project_finish.php";
				});
			}				
	</script>