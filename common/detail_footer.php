<!-- common/detail_footer.php -->

<div class="detail-bar">
    <div class="button">
        <img class="button-icon" src="/tishoo/img/bookmark.svg" alt="">
        <div class="qna">찜하기</div>
    </div>

    <div class="button">
        <img class="button-icon" src="/tishoo/img/qna.svg" alt="">
        <div class="qna">QnA</div>
    </div>

    <div class="buttons">
        <b class="text">지원하기</b>
    </div>
</div>

<style>

.detail-bar {
  	width: 100%;
  	/* ❌ 여기에 있던 absolute/bottom/left 제거 */
  	/* position: absolute;
  	bottom: 0;
  	left: 0; */
  	box-shadow: 0px -1px 8px rgba(0, 0, 0, 0.06);
  	background-color: #fff;
  	display: flex;
  	align-items: center;
  	padding: 0.875rem 1rem;
  	box-sizing: border-box;
  	gap: 2.25rem;
  	text-align: center;
  	font-size: 0.625rem;
  	color: #757575;
  	font-family: Pretendard;
  	/* z-index도 사실 필수는 아님, 남겨둬도 크게 문제는 없음 */
}
.detail-bar .button {
  	width: 2rem;
  	display: flex;
  	flex-direction: column;
  	align-items: center;
  	gap: 0.25rem;
}
.detail-bar .button-icon {
  	align-self: stretch;
  	height: 2rem;
  	border-radius: 99px;
  	max-width: 100%;
  	overflow: hidden;
  	flex-shrink: 0;
}
.detail-bar .qna {
  	align-self: stretch;
  	position: relative;
  	letter-spacing: -0.03em;
  	line-height: 130%;
}
.detail-bar .buttons {
  	height: 2.875rem;
  	flex: 1;
  	border-radius: 99px;
  	background-color: #1e78ff;
  	overflow: hidden;
  	display: flex;
  	align-items: center;
  	justify-content: center;
  	padding: 1rem;
  	box-sizing: border-box;
  	text-align: left;
  	font-size: 0.875rem;
  	color: #fff;
  	font-family: 'Spoqa Han Sans Neo';
}
.detail-bar .text {
  	position: relative;
  	letter-spacing: -0.02em;
  	line-height: 1.25rem;
  	flex-shrink: 0;
}
</style>
