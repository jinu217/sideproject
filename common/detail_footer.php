<div class="footer-div">
    <div class="footer-button-parent">
        <div class="footer-item">
            <div class="footer-button">
                <img class="footer-button-icon" src="../img/bookmark.svg" alt="">
            </div>
            <div class="footer-qna">찜하기</div>
        </div>

        <div class="footer-item">
            <div class="footer-button">
                <img class="footer-button-icon" src="../img/qna.svg" alt="">
            </div>
            <div class="footer-qna">QnA</div>
        </div>
    </div>

    <div class="footer-buttons">
        <b class="footer-text">지원하기</b>
    </div>
</div>

<style>
.footer-div {
  	width: 100%;
  	height: 5.625rem;
  	position: relative;
  	box-shadow: 0px -1px 8px rgba(0, 0, 0, 0.06);
  	background-color: #fff;
  	display: flex;
  	align-items: center;
  	padding: 0.875rem 1.5rem;
  	box-sizing: border-box;
  	gap: 2.25rem;
  	font-size: 0.625rem;
  	color: #757575;
  	font-family: Pretendard;
}

/* 아이콘 + 텍스트 세로 정렬 묶음 */
.footer-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.footer-button-parent {
  	display: flex;
  	align-items: center;
  	gap: 1.25rem;
}

.footer-button {
    width: 2rem;
    height: 2rem;
    border-radius: 99px;
    background-color: #fff;
    border: 1px solid #dbdbdb;
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
}

.footer-button-icon {
    width: 1.1rem;
    height: 1.1rem;
    object-fit: cover;
}

.footer-qna {
  	letter-spacing: -0.03em;
  	line-height: 130%;
}

.footer-buttons {
  	height: 2.875rem;
  	flex: 1;
  	border-radius: 10px;
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

.footer-text {
  	letter-spacing: -0.02em;
  	line-height: 1.25rem;
  	flex-shrink: 0;
}
</style>
