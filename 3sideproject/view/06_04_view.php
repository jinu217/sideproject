<?php
// 06_04_view.php : 동료후기 탭
?>

<div style="width: 375px; height: 24px; padding-top: 30px; padding-bottom: 30px; padding-left: 16px; padding-right: 16px; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
    <div style="color: black; font-size: 18px; font-family: Pretendard; font-weight: 600; line-height: 18px;">전체 후기</div>
    <div style="color: black; font-size: 18px; font-family: Pretendard; font-weight: 600; line-height: 18px;"><?= $reviewCount ?></div>
</div>

<div style="width: 375px; padding-bottom: 20px; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 40px; display: flex">

    <!-- 평균/만족 카드 -->
    <div style="width: 343px; height: 72px; padding: 12px 0; background: white; border-radius: 12px; outline: 1px rgba(112,115,124,0.16) solid; outline-offset: -1px; justify-content: center; align-items: center; gap: 47px; display: inline-flex">
        <div style="width: 104px; flex-direction: column; justify-content: flex-start; align-items: center; display: inline-flex">
            <div style="width: 48px; height: 24px; padding: 10px; justify-content: center; align-items: center; display: inline-flex">
                <div style="width: 50px; height: 31px; text-align: center; color: black; font-size: 22px; font-family: Pretendard; font-weight: 600; line-height: 30.8px;">
                    <?= $avgDisplay ?>
                </div>
            </div>
            <div id="averageStars" style="display:flex; justify-content:center; align-items:center; gap:2px; margin-top:4px;"></div>
        </div>
        <div style="width: 75px; flex-direction: column; justify-content: flex-start; align-items: center; display: inline-flex">
            <div style="align-self: stretch; height: 36px; padding: 10px; justify-content: center; align-items: center; display: inline-flex">
                <div style="width: 62.98px; height: 31px; text-align: center; color: black; font-size: 22px; font-family: Pretendard; font-weight: 600; line-height: 30.8px;">
                    <?= $positiveRate ?>%
                </div>
            </div>
            <div style="width: 40px; height: 12px; padding: 10px; justify-content: center; align-items: center; display: inline-flex">
                <div style="width: 89.88px; height: 18px; text-align: center; color: #737373; font-size: 10px; font-family: Pretendard; font-weight: 500; line-height: 13px;">만족후기</div>
            </div>
        </div>
    </div>

    <?php if ($reviewCount === 0): ?>

        <div style="width: 343px; height: 33px; border-radius: 8px; border: 1px rgba(112,115,124,0.16) solid; display: flex; align-items: center; gap: 8px">
            <div style="padding-left:16px; color: #737373; font-size: 11px; font-family: Pretendard; font-weight: 700; line-height: 13px;">
                아직 받은 동료 후기가 없습니다.
            </div>
        </div>

    <?php else: ?>

        <?php foreach ($reviews as $rev): ?>
            <?php
                $rating = (int)$rev['rating'];
                $ratingDisplay = number_format($rating, 1);
                $reviewerName = $rev['is_anonymous'] ? "익명" : $rev['reviewer_name'];
                $relative = relativeTimeKor($rev['created_at']);
            ?>
            <div style="width: 343px; height: 148.98px; position: relative; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
                <div style="justify-content: flex-start; align-items: center; display: inline-flex">
                    <img src="img/star.svg" style="width: 20px; height: 20px">
                    <div style="width: 32px; text-align: center; color: black; font-size: 18px; font-family: Pretendard; font-weight: 600; line-height: 25.2px;">
                        <?= $ratingDisplay ?>
                    </div>
                    <img src="img/more_horiz.svg" style="padding-left: 270px">
                </div>
                <div style="padding-top: 10px; padding-left: 4px; width: 343px; height: 39.17px; color: black; font-size: 12px; font-family: Pretendard; font-weight: 500; line-height: 21px;">
                    <?= nl2br(htmlspecialchars($rev['comment'])) ?>
                </div>

                <!-- 작성자 / 상대시간 (이름 길이에 따라 자동 조정) -->
                <div style="padding-left:4px; padding-bottom: 10px; display:flex; align-items:center; gap:3px;">
                    <div style="text-align: center; color: #737373; font-size: 12px;
                                font-family: Pretendard; font-weight: 500; line-height: 18px;">
                        <?= htmlspecialchars($reviewerName) ?>
                    </div>
                    <div style="color: #737373; font-size: 12px; font-family: Pretendard;
                                font-weight: 500; line-height: 18px;">·</div>
                    <div style="text-align: center; color: #737373; font-size: 12px;
                                font-family: Pretendard; font-weight: 500; line-height: 18px;">
                        <?= htmlspecialchars($relative) ?>
                    </div>
                </div>

                <div style="width: 343px; height: 32.54px; border-radius: 8px; border: 1px rgba(112,115,124,0.16) solid; display: flex; align-items: center; gap: 8px">
                    <div style="padding-left:16px; color: #737373; font-size: 10px; font-family: Pretendard; font-weight: 700; line-height: 13px;">
                        함께한 프로젝트
                    </div>
                    <div style="color: #737373; font-size: 10px; font-family: Pretendard; font-weight: 500; line-height: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= htmlspecialchars($rev['project_title']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>
