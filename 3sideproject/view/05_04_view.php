<?php
    include_once 'connect.php';

    // 현재 프로젝트 (시연용 1번 고정, 필요 시 GET으로 받기)
    $project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 1;

    // 화면에 보여줄 순서 (디자인 순서 그대로)
    $nameOrder = [
        '허윤선', '김민경',
        '김호진', '조태연',
        '이수아', '박주안',
        '김진우', '임재이'
    ];

    // DB에서 이 이름들에 해당하는 id 가져오기
    $placeholders = implode(',', array_fill(0, count($nameOrder), '?'));
    $sql = "SELECT id, name FROM users WHERE name IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    // ssssssss (8명)
    $types = str_repeat('s', count($nameOrder));
    $stmt->bind_param($types, ...$nameOrder);
    $stmt->execute();
    $result = $stmt->get_result();

    $userMap = [];
    while ($row = $result->fetch_assoc()) {
        $userMap[$row['name']] = (int)$row['id'];
    }
    $stmt->close();

    // 이름으로 user_id 가져오는 헬퍼
    function getUserIdByName($map, $name) {
        return isset($map[$name]) ? $map[$name] : 0;
    }
?>

<div style="width: 100%; padding-top: 40px; padding-bottom: 40px; background: white; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 50px; display: inline-flex">
    <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: center; gap: 20px; display: flex">
        <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
            <img src="./img/arrow_back_ios_new.svg" style="width: 20px; height: 20px; cursor: pointer;"onclick="history.back()">
            <div style="width: 8.71px; height: 15.80px;"></div>
            <div style="justify-content: flex-start; align-items: flex-start; gap: 1.99px; display: flex">
                <div style="padding-left: 1.99px; padding-right: 1.99px; justify-content: center; align-items: center; gap: 5.98px; display: flex">
                    <div style="text-align: right; color: #333333; font-size: 20px; font-family: Pretendard; font-weight: 600; line-height: 28px; word-wrap: break-word">팀원 후기 작성하기</div>
                </div>
            </div>
            <div style="width: 20px; height: 20px;"></div>
            <div style="width: 8.71px; height: 15.80px;"></div>
        </div>
    </div>
    <div style="align-self: stretch; padding-left: 16px; padding-right: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
            <div style="text-align: right; color: #333333; font-size: 16px; font-family: Pretendard; font-weight: 600; line-height: 24px; word-wrap: break-word">팀원 선택하기</div>
        </div>
        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
            <div style="padding-bottom: 16px; text-align: right; color: #333333; font-size: 13px; font-family: Pretendard; font-weight: 400; line-height: 19.50px; word-wrap: break-word">후기를 남길 팀원을 선택해주세요.</div>
        </div>

        <!-- 1행: 허윤선 / 김민경 -->
        <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '허윤선') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">허윤선</div>
                    </div>
                </div>
            </a>
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '김민경') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">김민경</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- 2행: 김호진 / 조태연 -->
        <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '김호진') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">김호진</div>
                    </div>
                </div>
            </a>
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '조태연') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">조태연</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- 3행: 이수아 / 박주안 -->
        <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '이수아') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">이수아</div>
                    </div>
                </div>
            </a>
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '박주안') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">박주안</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- 4행: 김진우 / 임재이 -->
        <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '김진우') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">김진우</div>
                    </div>
                </div>
            </a>
            <a href="05_05_tim_review.php?project_id=<?= $project_id ?>&target_user_id=<?= getUserIdByName($userMap, '임재이') ?>"
               style="flex: 1 1 0; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex; text-decoration:none; color:inherit;">
                <div style="flex: 1 1 0; padding-left: 14px; padding-right: 14px; padding-top: 12px; padding-bottom: 12px; background: #F8FAFC; border-radius: 20px; outline: 1px #CBD5E1 solid; outline-offset: -1px; flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 7px; display: flex">
                        <img style="width: 61px; height: 61px; position: relative; border-radius: 99px" src="https://placehold.co/61x61" />
                        <div style="text-align: right; justify-content: center; display: flex; flex-direction: column; color: #0F172A; font-size: 14px; font-family: Pretendard; font-weight: 600; line-height: 21px; word-wrap: break-word">임재이</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
