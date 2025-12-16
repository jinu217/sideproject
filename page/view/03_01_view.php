  	<div class="mypage-">
    		<div class="parent">
      			<b class="b">티슈력 안내</b>
      			<img src="../img/close.svg" class="close-icon" alt="" id="closeIcon">
      			
    		</div>
    		<div class="frame-parent">
      			<div class="tishoo-parent">
        				<b class="tishoo">Tishoo의 신뢰 지표</b>
        				<div class="div">티슈력은 Tishoo 멤버의 신뢰도를 한눈에 파악할 수 있는 지표입니다. 처음 50도에서 시작하여, 멤버의 다양한 활동에 따라 신뢰도가 변동합니다.</div>
      			</div>
      			<div class="frame-group">
        				<div class="tishoo-parent">
          					<b class="tishoo">티슈력 지수</b>
          					<div class="div">티슈력은 0~100도까지 있으며, 프로젝트 완수율, 팀원들의 평가 등에 따라 티슈력이 올라가거나 내려갈 수 있습니다.</div>
        				</div>
        				<div class="container">
        				</div>
      			</div>
      			<div class="tishoo-parent">
        				<b class="tishoo">티슈력 올리는 TIP</b>
        				<div class="chat-container">
          					<ul class="chat">
            						<li class="li">프로젝트 완주</li>
            						<li class="li">팀원들의 긍정적인 평가</li>
            						<li class="li">뱃지 획득</li>
            						<li class="li">관심 팀원 / 멘토에 등록</li>
            						<li>Chat에 빠른 답장</li>
          					</ul>
        				</div>
      			</div>
      			<div class="frame-div">
        				<b class="tishoo">티슈력이 내려갔다면?</b>
        				<div class="chat-container2">
          					<ul class="chat">
            						<li class="li">프로젝트 완주 실패</li>
          					</ul>
          					<p class="p">       프로젝트를 끝까지 끝내지 못했다면 티슈력이 내려가요.</p>
          					<p class="p">&nbsp;</p>
          					<ul class="chat">
            						<li class="li">팀원들의 부정적인 평가</li>
          					</ul>
          					<p class="p">       프로젝트가 끝난 후, 팀원들의 평가에서 부정적인 평가를 받으면 티슈력이 내려가요.</p>
          					<p class="p">&nbsp;</p>
          					<ul class="chat">
            						<li class="li">Chat에 무응답 / 느린 답변</li>
          					</ul>
          					<p class="p">       채팅을 24시간 내에 확인하지 않거나 답장하지 않을 시 티슈력이 조금씩 내려가요.</p>
        				</div>
      			</div>
    		</div>
  	</div>
  	

    <script>
        var closeIcon = document.getElementById("closeIcon");
        if (closeIcon) {
            closeIcon.addEventListener("click", function () {
                window.parent.postMessage({ action: "closeTishooModal" }, "*");
            });
        }
    </script>