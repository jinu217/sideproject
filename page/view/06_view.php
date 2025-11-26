<?php
// /tishoo/page/view/06_view.php

// ===========================
// 1) DB 연결
// ===========================
include_once '../connect.php';

// ===========================
// 2) 유저 파라미터 (예: ?user=1)
// ===========================
$user_id = isset($_GET['user']) ? intval($_GET['user']) : 0;

if ($user_id <= 0) {
    echo "<div style='padding:20px; font-family:Pretendard;'>잘못된 접근입니다. (?user=유저ID 필요)</div>";
    return;
}

// ===========================
// 3) 유저 정보 조회
// ===========================
$sql  = "SELECT id, name, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user   = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    echo "<div style='padding:20px; font-family:Pretendard;'>해당 유저를 찾을 수 없습니다.</div>";
    return;
}

// ===========================
// 4) 동료 후기 조회
// ===========================
$sql = "
    SELECT
        pr.rating,
        pr.comment,
        pr.is_anonymous,
        pr.created_at,
        u.name  AS reviewer_name,
        p.title AS project_title
    FROM peer_reviews pr
    JOIN users    u ON pr.reviewer_id   = u.id
    JOIN projects p ON pr.project_id    = p.id
    WHERE pr.target_user_id = ?
    ORDER BY pr.created_at DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();

$reviews       = [];
$sumRating     = 0;
$positiveCount = 0;

while ($row = $res->fetch_assoc()) {
    $reviews[] = $row;
    $r         = (float)$row['rating'];
    $sumRating += $r;
    if ($r >= 4) {
        $positiveCount++;
    }
}
$stmt->close();

$reviewCount   = count($reviews);
$avgRating     = $reviewCount > 0 ? $sumRating / $reviewCount : 0;
$avgDisplay    = $reviewCount > 0 ? number_format($avgRating, 1) : '0.0';
$positiveRate  = $reviewCount > 0 ? round($positiveCount * 100 / $reviewCount) : 0;

// 상대 시간 (동료후기 탭에서 사용 가능)
function relativeTimeKor($datetimeStr) {
    $ts = strtotime($datetimeStr);
    if ($ts === false) return "";

    $diff = time() - $ts;
    if ($diff < 60) return "방금 전";
    if ($diff < 3600) return floor($diff / 60) . "분 전";
    if ($diff < 86400) return floor($diff / 3600) . "시간 전";
    if ($diff < 86400 * 7) return floor($diff / 86400) . "일 전";
    if ($diff < 86400 * 30) return floor($diff / (86400 * 7)) . "주 전";
    return date("Y.m.d", $ts);
}

// ===========================
// 5) 헤더/칩/티슈력 계산
// ===========================

// 유저 정보 기본값 방어
$user_name = isset($user['name']) ? $user['name'] : '이름 없음';
$user_role = isset($user['role']) ? $user['role'] : '역할 정보 없음';

// 역할에 따른 Hacker / Hipster / Hustler 매핑
$chipLabel = 'Hipster'; // 기본값
$roleText  = $user_role;

// 한글 role에 "개발" / "디자인" / "기획" 같은 단어가 있다고 가정
if (mb_stripos($user_role, '개발') !== false) {
    $chipLabel = 'Hacker';
} elseif (
    mb_stripos($user_role, '디자인') !== false ||
    mb_stripos($user_role, '디자이너') !== false ||
    mb_stripos($user_role, 'UI/UX') !== false
) {
    $chipLabel = 'Hipster';
} elseif (
    mb_stripos($user_role, '기획') !== false ||
    mb_stripos($user_role, 'PM') !== false
) {
    $chipLabel = 'Hustler';
}

// 티슈력 점수 (평균 평점 기반 → 0~100점)
$avgRating    = isset($avgRating) ? (float)$avgRating : 0;
$tishooScore  = $reviewCount > 0 ? round($avgRating * 20) : 0;  // 5점 만점 → 100점
$avgDisplay   = $reviewCount > 0 ? number_format($avgRating, 1) : '0.0';
$positiveRate = isset($positiveRate) ? (int)$positiveRate : 0;

// 게이지바 폭(%)
$gaugePercent = max(0, min(100, $tishooScore));
?>

<div class="profile-page">

    <!-- ✅ 상단 프로필 헤더 영역 -->
    <div class="profile-header">
        <div class="profile-header-top">
            <!-- 뒤로가기 아이콘 -->
            <img class="profile-header-icon" src="img/arrow_left.svg" alt="뒤로가기"
                 onclick="history.back();" style="cursor:pointer;">
            
            <div class="profile-header-share">
                <img class="profile-header-icon" src="img/share.svg" alt="공유">
                <img class="profile-header-icon" src="img/settings.svg" alt="설정">
            </div>
        </div>

        <div class="profile-header-main">
            <div class="profile-header-main-row">
                <div class="profile-header-user">
                    <!-- 프로필 이미지 -->
                    <img class="profile-header-avatar" src="https://placehold.co/94x89" alt="프로필">
                    
                    <div class="profile-header-user-right">
                        <div class="profile-header-user-title">
                            <div class="profile-header-role-wrap">
                                <div class="profile-header-role-chip">
                                    <!-- ✅ 역할에 따른 Hacker / Hipster / Hustler -->
                                    <div class="profile-header-role-text">
                                        <?= htmlspecialchars($chipLabel) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-header-name-block">
                                <!-- ✅ 유저 이름 -->
                                <b class="profile-header-name">
                                    <?= htmlspecialchars($user_name) ?>
                                </b>
                                <!-- ✅ 유저 한 줄 소개(역할) -->
                                <div class="profile-header-subtitle">
                                    <?= htmlspecialchars($roleText) ?>
                                </div>
                            </div>
                        </div>

                        <div class="profile-header-follow-row">
                            <div class="profile-header-follow-item">
                                <div class="profile-header-follow-text">팔로잉</div>
                                <b class="profile-header-follow-text">123</b>
                            </div>
                            <div class="profile-header-follow-item-wrap">
                                <div class="profile-header-follow-item">
                                    <div class="profile-header-follow-text">팔로워</div>
                                    <b class="profile-header-follow-text">123</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ✅ 티슈력 영역 -->
                <div class="profile-header-score-wrap">
                    <div class="profile-header-score-row">
                        <div class="profile-header-score-icon-wrap">
                            <!-- 배지 아이콘 (원하면 실제 svg로 교체) -->
                            <div class="profile-header-badge-icon">
                                <div class="profile-header-badge-shape">
                                    <img class="profile-header-badge-bg1" src="img/tishoo_badge_bg1.svg" alt="">
                                    <img class="profile-header-badge-bg2" src="img/tishoo_badge_bg2.svg" alt="">
                                    <img class="profile-header-badge-bg3" src="img/tishoo_badge_bg3.svg" alt="">
                                </div>
                                <img class="profile-header-badge-center" src="img/tishoo_badge_center.svg" alt="">
                                <div class="profile-header-badge-inner">
                                    <div class="profile-header-badge-inner-shape">
                                        <img class="profile-header-badge-inner-icon" src="img/tishoo_badge_inner.svg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="profile-header-score-label">티슈력</div>

                            <!-- i 아이콘 + 툴팁 -->
                            <img class="profile-header-info-icon" id="tishooInfoBtn" src="img/tishoo_power_i.svg" alt="정보">

                            <div class="profile-header-tooltip" id="tishooTooltip" style="display:none;">
                                <img class="profile-header-tooltip-arrow" src="img/tishoo_power_i2.svg" alt="">
                                <div class="profile-header-tooltip-box">
                                    <div class="profile-header-tooltip-text">
                                        프로젝트 평균 완주율을 나타내요
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 게이지 바 + 점수 -->
                        <div class="profile-header-score-bar-row">
                            <div class="profile-header-score-bar">
                                <div class="profile-header-score-bar-bg"></div>
                                <!-- ✅ 점수에 따라 width 퍼센트로 조정 -->
                                <div class="profile-header-score-bar-fill"
                                     style="width: <?= $gaugePercent ?>%;"></div>
                            </div>
                            <div class="profile-header-score-value">
                                <?= $tishooScore ?>점
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 채팅 / 협업 제안 버튼 -->
            <div class="profile-header-actions">
                <div class="profile-header-btn-secondary">
                    <div class="profile-header-btn-text">채팅하기</div>
                </div>
                <div class="profile-header-btn-primary">
                    <b class="profile-header-btn-text-bold">협업제안 보내기</b>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ 탭 네비게이션 -->
    <div class="profile-tabs">
        <div class="profile-tab-btn is-active" data-tab="profile">
            <span class="profile-tab-label">프로필</span>
        </div>
        <div class="profile-tab-btn" data-tab="project">
            <span class="profile-tab-label">프로젝트</span>
        </div>
        <div class="profile-tab-btn" data-tab="portfolio">
            <span class="profile-tab-label">포트폴리오</span>
        </div>
        <div class="profile-tab-btn" data-tab="review">
            <span class="profile-tab-label">동료후기</span>
        </div>
    </div>

    <!-- ✅ 탭 컨텐츠 영역 -->
    <div id="tab-profile" class="profile-tab-panel">
        <?php
        $profileTab = __DIR__ . '/06_01_view_tab_profile.php';
        if (file_exists($profileTab)) {
            // 여기서 $reviewCount, $avgRating, $positiveRate, $reviews 사용 가능
            include $profileTab;
        }
        ?>
    </div>

    <div id="tab-project" class="profile-tab-panel" style="display:none;">
        <?php
        $projectTab = __DIR__ . '/06_02_view_tab_project.php';
        if (file_exists($projectTab)) {
            include $projectTab;
        }
        ?>
    </div>

    <div id="tab-portfolio" class="profile-tab-panel" style="display:none;">
        <?php
        $portfolioTab = __DIR__ . '/06_03_view_tab_portfolio.php';
        if (file_exists($portfolioTab)) {
            include $portfolioTab;
        }
        ?>
    </div>

    <div id="tab-review" class="profile-tab-panel" style="display:none;">
        <?php
        $reviewTab = __DIR__ . '/06_04_view_tab_review.php';
        if (file_exists($reviewTab)) {
            // 여기서도 $reviewCount, $avgRating, $positiveRate, $reviews 사용 가능
            include $reviewTab;
        }
        ?>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---------- 탭 전환 ----------
    const tabButtons = document.querySelectorAll('.profile-tab-btn');
    const panels = {
        profile:   document.getElementById('tab-profile'),
        project:   document.getElementById('tab-project'),
        portfolio: document.getElementById('tab-portfolio'),
        review:    document.getElementById('tab-review'),
    };

    function showProfileTab(name) {
        tabButtons.forEach(btn => {
            if (btn.dataset.tab === name) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });

        Object.entries(panels).forEach(([key, panel]) => {
            if (!panel) return;
            panel.style.display = (key === name) ? 'block' : 'none';
        });
    }

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.tab;
            if (!target) return;
            showProfileTab(target);
        });
    });

    // 초기: 프로필 탭
    showProfileTab('profile');

    // ---------- 티슈력 툴팁 ----------
    const infoBtn = document.getElementById("tishooInfoBtn");
    const tooltip = document.getElementById("tishooTooltip");
    if (infoBtn && tooltip) {
        infoBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            tooltip.style.display =
                (tooltip.style.display === "none" || tooltip.style.display === "")
                    ? "flex"
                    : "none";
        });
        document.addEventListener("click", function (e) {
            if (!tooltip.contains(e.target) && e.target !== infoBtn) {
                tooltip.style.display = "none";
            }
        });
    }

    // ---------- 동료후기 평균 별점 아이콘 (필요시 사용) ----------
    const avg = <?= json_encode((float)$avgRating) ?>;
    const avgStarsContainer = document.getElementById("averageStars");
    if (avgStarsContainer) {
        avgStarsContainer.innerHTML = "";
        for (let i = 1; i <= 5; i++) {
            const img = document.createElement("img");
            img.className = "frame-child"; // 기존 스타일 재사용
            const starScore = avg - (i - 1);
            if (starScore >= 0.75) {
                img.src = "img/star_on.svg";
            } else if (starScore >= 0.25) {
                img.src = "img/star_half.svg";
            } else {
                img.src = "img/star_off.svg";
            }
            avgStarsContainer.appendChild(img);
        }
    }
});
</script>
