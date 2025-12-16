<?php
// 03_02_mypage_setting.php / view/03_02_view.php : 마이페이지 프로필 수정 (뷰 + 처리)

include_once '../connect.php';

// 1) 현재 유저 ID (?user=... 없으면 1)
$user_id = isset($_GET['user']) ? (int)$_GET['user'] : 1;
if ($user_id <= 0) {
    $user_id = 1;
}

// 2) 저장(POST) 처리: 닉네임 + 대표 이미지 업데이트
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ===========================
    // 닉네임 업데이트
    // ===========================
    $newNickname = isset($_POST['name']) ? trim($_POST['name']) : '';

    if ($newNickname !== '') {
        // user_profiles에 행이 있는지 확인
        $stmt = $conn->prepare("SELECT user_id FROM user_profiles WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $exists = $res->fetch_assoc();
        $stmt->close();

        if ($exists) {
            $stmt = $conn->prepare("UPDATE user_profiles SET nickname = ? WHERE user_id = ?");
            $stmt->bind_param("si", $newNickname, $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO user_profiles (user_id, nickname) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $newNickname);
            $stmt->execute();
            $stmt->close();
        }
    }

    // ===========================
    // 대표 이미지 업로드 처리
    // ===========================
    if (isset($_FILES['profile_image'])) {

        // 1) 업로드 에러 코드부터 확인
        if ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
            // 👉 여기 메시지 보이면, php.ini 설정(용량, file_uploads 등) 문제일 확률 높음
            die('이미지 업로드 실패, error code = ' . (int)$_FILES['profile_image']['error']);
        }

        $tmpName  = $_FILES['profile_image']['tmp_name'];
        $origName = $_FILES['profile_image']['name'];
        $ext      = pathinfo($origName, PATHINFO_EXTENSION);

        // 1) 이 유저의 기존 프로필 이미지 경로 가져오기 (DB에 저장된 값: ../img/profile/..)
        $oldImagePath = null;
        $stmt = $conn->prepare("SELECT profile_image_url FROM user_profiles WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($rowOld = $res->fetch_assoc()) {
            $oldImagePath = $rowOld['profile_image_url'];
        }
        $stmt->close();

        // 2) 서버 실제 경로 / 브라우저 경로 설정 (realpath 대신 dirname 사용)
        //
        // __DIR__             : /var/www/html/Team3_25/page/view
        // dirname(__DIR__)    : /var/www/html/Team3_25/page
        // dirname(__DIR__, 2) : /var/www/html/Team3_25  (프로젝트 루트)
        $baseDir = dirname(__DIR__, 2);                // /var/www/html/Team3_25

        // 서버 실제 저장 경로
        $uploadDirFs  = $baseDir . '/img/profile/';    // /var/www/html/Team3_25/img/profile/
        // 브라우저/DB용 상대 경로 (이 파일이 /page 아래 있으니까 ../img/...)
        $uploadDirUrl = '../img/profile/';

        // 디렉토리 없으면 생성
        if (!is_dir($uploadDirFs)) {
            @mkdir($uploadDirFs, 0777, true);
        }

        // 확장자 안전하게 처리
        $safeExt  = $ext ? $ext : 'png';
        $fileName = 'profile_user_' . $user_id . '_' . time() . '.' . $safeExt;

        // 실제 서버에 저장될 전체 경로
        $destPathFs = $uploadDirFs . $fileName;
        // DB/브라우저에서 사용할 상대 경로
        $imagePath  = $uploadDirUrl . $fileName;

        // 3) 실제로 move_uploaded_file이 되는지 확인
        if (!move_uploaded_file($tmpName, $destPathFs)) {
            // 👉 여기 메시지 보이면, 경로/권한 문제
            die('move_uploaded_file 실패: ' . htmlspecialchars($destPathFs, ENT_QUOTES, 'UTF-8'));
        }

        // 4) DB에 새 경로 저장 (있으면 UPDATE, 없으면 INSERT)
        $stmt = $conn->prepare("SELECT user_id FROM user_profiles WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res    = $stmt->get_result();
        $exists = $res->fetch_assoc();
        $stmt->close();

        if ($exists) {
            $stmt = $conn->prepare("UPDATE user_profiles SET profile_image_url = ? WHERE user_id = ?");
            $stmt->bind_param("si", $imagePath, $user_id);
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO user_profiles (user_id, profile_image_url) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $imagePath);
            $stmt->execute();
            $stmt->close();
        }

        // 5) 예전 이미지 파일 삭제 (기본이미지 제외)
        if (!empty($oldImagePath)
            && $oldImagePath !== $imagePath
            && $oldImagePath !== '../img/profile_img_setting.png'
        ) {
            // oldImagePath 는 ../img/... 형태니까, 실제 서버 경로로 변환
            // 예: '../img/profile/aaa.png' -> 'img/profile/aaa.png'
            $relativePath = ltrim(str_replace('../', '', $oldImagePath), '/');
            $oldFsPath    = $baseDir . '/' . $relativePath;   // /var/www/html/Team3_25/img/profile/aaa.png

            if (file_exists($oldFsPath)) {
                @unlink($oldFsPath);
            }
        }
    }


    // ✅ 저장 후 해당 유저의 마이페이지로 이동
    header("Location: 03_mypage.php?user=" . $user_id);
    exit;
}

// 3) 현재 닉네임 + 이름 + 대표 이미지 불러오기
$sql = "
    SELECT 
        u.name,
        p.nickname,
        p.profile_image_url
    FROM users u
    LEFT JOIN user_profiles p ON p.user_id = u.id
    WHERE u.id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// 닉네임이 있으면 닉네임, 없으면 이름
$currentName = $row['nickname'] ?? ($row['name'] ?? '이름 없음');

$profileImage = !empty($row['profile_image_url'])
    ? $row['profile_image_url']
    : '../img/profile_img_setting.png';
?>

<!-- ✅ 대표 이미지 + 닉네임(이름 입력란) 수정 가능하도록 form으로 감쌈 -->
<form id="profileForm" method="post" enctype="multipart/form-data">
  	<div class="div">
    		<div class="inner">
      			<div class="arrow-back-ios-new-parent">
        				<img src="../img/arrow_left2.svg"
                             class="arrow-back-ios-new-icon"
                             alt=""
                             id="btnBack">
        				<div class="div2">프로필 수정</div>
      			</div>
    		</div>
    		<div class="frame-parent">
      			<div class="frame-wrapper">
        				<div class="frame-child" alt="">
							<!-- ✅ DB에서 불러온 대표 이미지 -->
							<img src="<?php echo htmlspecialchars($profileImage, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="profile-base"
                                 alt="프로필">

							<img src="../img/profile_img_setting1.svg" class="icon-edit" alt="">
							<img src="../img/camera.png" class="icon-camera" alt="">

							<!-- ✅ 실제 업로드 input (숨김) -->
							<input type="file" name="profile_image" id="profile_image_input" accept="image/*" style="display:none;">
						</div>
      			</div>

      			<div class="navi">
        				<div class="component-1">
          					<div class="text">프로필</div>
        				</div>
        				<div class="component-5">
          					<div class="text2">프로젝트</div>
        				</div>
        				<div class="component-5">
          					<div class="text2">포트폴리오</div>
        				</div>
        				<div class="component-5">
          					<div class="text2">동료후기</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-group">
          					<div class="frame-div">
            						<div class="parent">
              							<div class="uiux">이름</div>
              							<div class="div4">*</div>
            						</div>
          					</div>
          					<div class="group">
            						<!-- ✅ 닉네임을 입력할 수 있는 input (DB 닉네임 또는 이름으로 채움) -->
            						<input type="text"
										   name="name"
										   class="uiux"
										   value="<?php echo htmlspecialchars($currentName, ENT_QUOTES, 'UTF-8'); ?>"
										   style="border:none; outline:none; background:transparent; width: 80%; padding:0; margin:0;">
            						<div class="div6">사용가능</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-group">
          					<div class="frame-div">
            						<div class="parent">
              							<div class="uiux">전화번호</div>
              							<div class="div4">*</div>
            						</div>
          					</div>
          					<div class="group">
            						<div class="uiux">01032626679</div>
            						<div class="div6">인증완료</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-group">
          					<div class="frame-wrapper5">
            						<div class="parent">
              							<div class="uiux">이메일</div>
              							<div class="div4">*</div>
            						</div>
          					</div>
          					<div class="leesuahh1234gmailcom-wrapper">
            						<div class="leesuahh1234gmailcom">leesuahh1234@gmail.com</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-wrapper6">
        				<div class="frame-parent4">
          					<div class="frame-wrapper7">
            						<div class="parent4">
              							<div class="uiux">직종/목적</div>
              							<div class="div4">*</div>
            						</div>
          					</div>
          					<div class="parent5">
            						<div class="uiux">대학(원)생</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="parent6">
            						<div class="uiux">3년차</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="uiux-parent">
            						<div class="uiux">UI/UX디자이너</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="parent7">
            						<div class="uiux">목적</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
        				</div>
      			</div>

      			<div class="frame-wrapper8">
        				<div class="frame-group">
          					<div class="frame-wrapper9">
            						<div class="wrapper">
              							<div class="div18">대학(원)생 인증해주세요</div>
            						</div>
          					</div>
          					<div class="frame">
            						<div class="uiux">한경대학교</div>
          					</div>
          					<div class="frame">
            						<div class="uiux">시각영상디자인전공</div>
          					</div>
          					<div class="parent8">
            						<div class="uiux">학사(재학중)</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-parent6">
          					<div class="frame-div">
            						<div class="wrapper3">
              							<div class="uiux">소개</div>
            						</div>
          					</div>
          					<div class="uiux-wrapper">
            						<div class="uiux">UI/UX 분야로 취업을 희망하는 취준생입니다.<br>함께 열정적으로 프로젝트를 진행할 팀원을 찾고 있습니다!</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-wrapper12">
        				<div class="frame-parent7">
          					<div class="frame-wrapper9">
            						<div class="wrapper4">
              							<div class="uiux">경력사항(소속)</div>
            						</div>
          					</div>
          					<div class="parent9">
            						<div class="uiux">2025-06</div>
            						<img src="../img/calendar.svg" class="calendar-streamline-lucide-icon" alt="">
          					</div>
          					<div class="parent10">
            						<div class="uiux">2024-12</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="frame-parent8">
            						<div class="frame-parent9">
              							<div class="frame-wrapper14">
                								<div class="wrapper4">
                  									<div class="uiux">조직 정보</div>
                								</div>
              							</div>
              							<div class="parent11">
                								<div class="uiux">기타(학교 등)</div>
                								<src="../img/arrow_down.svg" img class="vector-icon" alt="">
              							</div>
              							<div class="parent11">
                								<div class="uiux">기타(학교 등)</div>
                								<src="../img/arrow_down.svg" img class="vector-icon" alt="">
              							</div>
              							<div class="parent13">
                								<div class="uiux">기타 서비스</div>
                								<src="../img/arrow_down.svg" img class="vector-icon" alt="">
              							</div>
              							<div class="wrapper6">
                								<div class="div30">직무 정보</div>
              							</div>
            						</div>
            						<img src="../img/profile_plus.png" class="plus-icon" alt="">
          					</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-group">
          					<div class="frame-div">
            						<div class="wrapper">
              							<div class="uiux">보유 기술</div>
            						</div>
          					</div>
          					<div class="chipxs-parent">
            						<div class="chipxs">
              							<div class="text5">Figma</div>
              							<div class="chipxs-child" alt="">
											<img src="../img/profile_minus.svg">
										</div>
            						</div>
            						<div class="chipxs2">
              							<div class="text5">Notion</div>
              							<div class="chipxs-child" alt="">
											<img src="../img/profile_minus.svg">
										</div>
            						</div>
            						<div class="chipxs3">
              							<div class="text5">Illustrator</div>
              							<div class="chipxs-child" alt="">
											<img src="../img/profile_minus.svg">
										</div>
            						</div>
            						<div class="chipxs4">
              							<div class="text5">Photoshop</div>
              							<div class="chipxs-child" alt="">
											<img src="../img/profile_minus.svg">
										</div>
            						</div>
          					</div>
          					<div class="wrapper8">
            						<div class="div30">툴 정보</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-wrapper17">
        				<div class="frame-parent11">
          					<div class="frame-wrapper18">
            						<div class="wrapper4">
              							<div class="uiux">참여 방식</div>
            						</div>
          					</div>
          					<div class="parent14">
            						<div class="uiux">온라인</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="parent15">
            						<div class="uiux">주 1회</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
          					<div class="frame-parent12">
            						<div class="frame-wrapper19">
              							<div class="wrapper3">
                								<div class="uiux">가능한 요일</div>
              							</div>
            						</div>
            						<div class="frame-parent13">
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">월</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">화</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">수</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">목</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">금</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">토</div>
                								</div>
              							</div>
              							<div class="frame-wrapper20">
                								<div class="wrapper11">
                  									<div class="div37">일</div>
                								</div>
              							</div>
            						</div>
          					</div>
          					<div class="frame-parent14">
            						<div class="frame-div">
              							<div class="wrapper3">
                								<div class="uiux">가능한 시간대</div>
              							</div>
            						</div>
            						<div class="frame-parent15">
              							<div class="wrapper19">
                								<div class="div45">오전</div>
              							</div>
              							<div class="wrapper19">
                								<div class="div45">오후</div>
              							</div>
              							<div class="wrapper19">
                								<div class="div45">저녁</div>
              							</div>
            						</div>
          					</div>
        				</div>
      			</div>

      			<div class="frame-container">
        				<div class="frame-group">
          					<div class="frame-div">
            						<div class="wrapper">
              							<div class="uiux">MBTI</div>
            						</div>
          					</div>
          					<div class="entp-parent">
            						<div class="uiux">ENTP</div>
            						<img src="../img/arrow_down.svg" class="vector-icon" alt="">
          					</div>
        				</div>
      			</div>

      			<div class="frame-wrapper30">
        				<div class="frame-parent17">
          					<div class="frame-wrapper9">
            						<div class="wrapper">
              							<div class="uiux">관심사</div>
            						</div>
          					</div>
          					<div class="chipxs-group">
            						<div class="chipxs5">
              							<div class="text5">네트워킹</div>
            						</div>
            						<div class="chipxs5">
              							<div class="text5">그림</div>
            						</div>
            						<div class="chipxs5">
              							<div class="text5">지적 성장</div>
            						</div>
            						<div class="chipxs5">
              							<div class="text5">IT</div>
            						</div>
            						<div class="chipxs5">
              							<div class="text5">가치구현</div>
            						</div>
          					</div>
          					<div class="chipxs-container">
            						<div class="chipxs10">
              							<div class="text5">소셜네트워크</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">뷰티</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">패션</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">이커머스</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">금융</div>
            						</div>
          					</div>
          					<div class="chipxs-container">
            						<div class="chipxs10">
              							<div class="text5">엔터테이먼트</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">게임</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">의료/병원</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">종교</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">육아출산</div>
            						</div>
          					</div>
          					<div class="chipxs-container">
            						<div class="chipxs10">
              							<div class="text5">의료/병원</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">모빌리티</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">육아/출산</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">우주</div>
            						</div>
            						<div class="chipxs10">
              							<div class="text5">공유서비스</div>
            						</div>
          					</div>
        				</div>
      			</div>

      			<div class="div49">
        				<div class="div50" id="saveBtn">
          					<div class="wrapper23">
            						<div class="div18">저장</div>
          					</div>
        				</div>
      			</div>
    		</div>
  	</div>
</form>

<script>
  // 프로필 영역 클릭 시 파일 선택창 열기
  document.querySelector('.frame-child')?.addEventListener('click', function () {
      document.getElementById('profile_image_input').click();
  });

  // ✅ 파일 선택 시, 현재 페이지에서 프로필 이미지 미리보기 변경
  (function () {
      const fileInput  = document.getElementById('profile_image_input');
      const profileImg = document.querySelector('.profile-base');

      if (!fileInput || !profileImg) return;

      fileInput.addEventListener('change', function (e) {
          const file = e.target.files[0];
          if (!file) return;

          const previewUrl = URL.createObjectURL(file);
          profileImg.src = previewUrl;

          // 필요하면 로딩 후 메모리 해제
          // profileImg.onload = function () {
          //     URL.revokeObjectURL(previewUrl);
          // };
      });
  })();

  // 저장 버튼 클릭 시 form 제출
  document.getElementById('saveBtn')?.addEventListener('click', function () {
      document.getElementById('profileForm').submit();
  });

  // 🔙 상단 뒤로가기 클릭 시, 저장없이 해당 유저의 마이페이지로 이동
  (function () {
      const btnBack = document.getElementById('btnBack');
      if (!btnBack) return;

      const userId = <?php echo (int)$user_id; ?>;
      btnBack.addEventListener('click', function () {
          window.location.href = '03_mypage.php?user=' + userId;
      });
  })();
</script>

