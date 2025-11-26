<!-- common/detail_footer.php -->

<div class="detail-bar">
    <div class="button">
        <div class="button-icon-wrap">
            <img class="button-icon" src="../img/bookmark.svg" alt="">
        </div>
        <div class="qna">찜하기</div>
    </div>

    <div class="button">
        <div class="button-icon-wrap">
            <img class="button-icon" src="../img/qna.svg" alt="">
        </div>
        <div class="qna">QnA</div>
    </div>

    <div class="buttons">
        <b class="text">지원하기</b>
    </div>
</div>

<style>
.detail-bar {
    width: 100%;
    position: relative;
    box-shadow: 0px -1px 8px rgba(0, 0, 0, 0.06);
    background-color: #fff;
    display: flex;
    align-items: flex-start;      /* 🔥 아이콘/텍스트 세트 위쪽 맞춤 */
    padding: 0.875rem 1rem;
    box-sizing: border-box;
    gap: 2.25rem;
    font-size: 0.625rem;
    color: #757575;
    font-family: Pretendard;
}

/* 왼쪽 작은 버튼 두 개(세로 구조) */
.button {
    display: flex;
    flex-direction: column;       /* 🔥 위: 아이콘, 아래: 텍스트 */
    align-items: center;
    gap: 0.25rem;
    flex-shrink: 0;
}

/* 아이콘만 감싸는 동그란 pill */
.button-icon-wrap {
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

/* 아이콘 이미지 */
.button-icon {
    width: 1.1rem;
    height: 1.1rem;
    object-fit: cover;
}

/* 아래 텍스트 (찜하기 / QnA) */
.qna {
    letter-spacing: -0.03em;
    line-height: 130%;
}

/* 오른쪽 파란 지원하기 버튼 */
.buttons {
    height: 2.875rem;
    flex: 1;                      /* 🔥 남은 가로 공간 다 차지 */
    border-radius: 99px;
    background-color: #1e78ff;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    box-sizing: border-box;
    text-align: center;
    font-size: 0.875rem;
    color: #fff;
    font-family: 'Spoqa Han Sans Neo';
}

.text {
    letter-spacing: -0.02em;
    line-height: 1.25rem;
}

</style>
