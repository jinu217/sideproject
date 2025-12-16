<?php
// /tishoo/page/view/06_04_view_tab_review.php
?>

<div class="profile-tab-review">

    <div class="frame-parent">
        <!-- 상단: 전체 후기 요약 -->
        <div class="parent">
            <div class="div">전체 후기</div>
            <div class="div"><?= (int)$reviewCount ?></div>
        </div>

        <!-- 하단: 평점 요약 + 후기 리스트 -->
        <div class="div3">

            <!-- 평점 요약 카드 -->
            <div class="group">
                <div class="div4">
                    <div class="wrapper">
                        <!-- ✅ 평균 평점 숫자 -->
                        <div class="div5"><?= htmlspecialchars($avgDisplay) ?></div>
                    </div>
                    <!-- ✅ 이 컨테이너를 JS에서 별 5개로 채움 -->
                    <div class="star-parent" id="averageStars"></div>
                </div>

                <div class="div6">
                    <div class="inner">
                        <div class="container">
                            <!-- ✅ 만족 비율 (%) -->
                            <div class="div7"><?= (int)$positiveRate ?>%</div>
                        </div>
                    </div>
                    <div class="child">
                        <div class="frame">
                            <div class="div8">만족후기</div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($reviewCount === 0): ?>
                <!-- 후기 없을 때 -->
                <div style="padding:1rem 0; font-size:0.875rem; color:#737373;">
                    아직 등록된 동료후기가 없습니다.
                </div>
            <?php else: ?>

                <?php foreach ($reviews as $r): ?>
                    <?php
                        $rating      = (float)$r['rating'];
                        $ratingText  = number_format($rating, 1);
                        $projectName = $r['project_title'];
                        $comment     = $r['comment'];
                        $created     = isset($r['created_at']) ? relativeTimeKor($r['created_at']) : '';
                        $isAnon      = (int)$r['is_anonymous'] === 1;
                        $reviewer    = $isAnon ? '익명' : $r['reviewer_name'];
                    ?>

                    <div class="div9">
                        <!-- 상단: 별점 + 점수 -->
                        <div class="star-group">
                            <img class="frame-child3" src="../img/star_on.svg" alt="">
                            <div class="div10"><?= $ratingText ?></div>
                        </div>

                        <!-- 더보기 아이콘 (기획 나중에) -->
                        <img class="more-horiz-icon" src="../img/more_horiz.svg" alt="more">

                        <!-- 후기 본문 -->
                        <div class="div11">
                            <?= nl2br(htmlspecialchars($comment)) ?>
                        </div>

                        <!-- 하단 바 테두리 + 내부 텍스트/아이콘 -->
                        <div class="item">
                            <div class="item-label">함께한 프로젝트</div>
                            <div class="item-title"><?= htmlspecialchars($projectName) ?></div>
                            <img src="../img/arrow_right2.svg" class="item-arrow" alt="">
                        </div>

                        <!-- 작성자 + 시간 -->
                        <div class="frame-div">
                            <div class="div12"><?= htmlspecialchars($reviewer) ?></div>
                            <div class="div13">·</div>
                            <div class="div14"><?= htmlspecialchars($created) ?></div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</div>
