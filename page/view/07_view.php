<?php
// 07_notification.php

include_once '../connect.php';

// 1) 현재 유저 ID (?user=... 없으면 1)
$current_user_id = isset($_GET['user']) ? (int)$_GET['user'] : 1;
if ($current_user_id <= 0) {
    $current_user_id = 1;
}
?>

<div class="container">
    <div class="header">
        <div class="container2">
            <img src="../img/arrow_left.svg" class="button-icon" alt="" id="back-arrow">
            <div class="heading-1">
                <b class="b">알림</b>
            </div>
        </div>
        <div class="container3">
            <img src="../img/search.svg" class="button-icon2" alt="">
            <img src="../img/setting2.svg" class="button-icon2" alt="">
        </div>
    </div>

    <div class="container4">
        <div class="container5">
            <div class="heading-3">
                <b class="b2">알림 금지 모드</b>
            </div>
            <div class="container6">
                <div class="text">
                    <div class="div">07:00</div>
                </div>
                <div class="text2">
                    <div class="div2">부터</div>
                </div>
                <div class="text3">
                    <div class="div">18:30</div>
                </div>
                <div class="text4">
                    <div class="div2">까지 알림 금지</div>
                </div>
            </div>
        </div>
        <div class="container7">
            <div class="container8"></div>
        </div>
    </div>

    <div class="container9">
        <div class="container10">
            <div class="container11">
                <div class="heading-2">
                    <b class="b3">중요 알림</b>
                </div>
            </div>

            <!-- 중요 알림 1 -->
            <div class="container12">
                <div class="container13">
                    <div class="container14">
                        <div class="container15">
                            <div class="image"></div>
                        </div>
                    </div>
                    <div class="container-icon" alt="">
                        <img src="../img/notification1.svg">
                    </div>

                    <div class="container16">
                        <div class="container17">
                            <div class="container18">
                                <div class="heading-32">
                                    <b class="b3">팀 합류 제안</b>
                                </div>
                                <div class="text5">
                                    <b class="b5">중요</b>
                                </div>
                            </div>
                            <div class="text6">
                                <div class="div5">방금 전</div>
                            </div>
                        </div>
                        <div class="div6">'여행 기록 앱' 프로젝트에서 개발자 포지션으로 합류를 제안했어요!</div>
                    </div>
                </div>
            </div>

            <!-- 중요 알림 2 -->
            <div class="container19">
                <div class="container20">
                    <div class="container21">
                        <div class="container22">
                            <div class="image"></div>
                        </div>
                        <div class="container-icon2" alt="">
                            <img src="../img/notification2.svg">
                        </div>
                    </div>
                    <div class="container23">
                        <div class="container17">
                            <div class="container25">
                                <div class="heading-32">
                                    <b class="b3">지원 결과 안내</b>
                                </div>
                                <div class="text5">
                                    <b class="b5">중요</b>
                                </div>
                            </div>
                            <div class="text6">
                                <div class="div5">1시간 전</div>
                            </div>
                        </div>
                        <div class="ai">축하합니다! 'AI 챗봇 서비스' 프로젝트에 합류하게 되셨습니다. 팀 채팅방을 확인해보세요.</div>
                    </div>
                </div>
            </div>

            <!-- 중요 알림 3 : 프로젝트 완료 안내 (✅ 여기 클릭 시 모달) -->
            <div class="container19-1" id="project-finish">
                <div class="container20">
                    <div class="container21">
                        <div class="container22">
                            <div class="image"></div>
                        </div>
                        <div class="container-icon2" alt="">
                            <img src="../img/notification2.svg">
                        </div>
                    </div>
                    <div class="container23">
                        <div class="container17">
                            <div class="container32">
                                <div class="heading-32">
                                    <b class="b3">프로젝트 완료 안내</b>
                                </div>
                                <div class="text5">
                                    <b class="b5">중요</b>
                                </div>
                            </div>
                            <div class="text6">
                                <div class="div5">1시간 전</div>
                            </div>
                        </div>
                        <div class="ai">축하합니다! 'AI 챗봇 서비스' 프로젝트가 성공적으로 완료되었습니다. 프로젝트 후기를 남겨보세요.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 어제 알림 -->
        <div class="container33">
            <div class="container34">
                <b class="div2">어제</b>
            </div>
            <div class="container35">
                <div class="container36">
                    <div class="container21">
                        <div class="container22">
                            <div class="image"></div>
                        </div>
                        <div class="container-icon2" alt="">
                            <img src="../img/notification3.svg">
                        </div>
                    </div>
                    <div class="container39">
                        <div class="container40">
                            <div class="container41">
                                <div class="heading-32">
                                    <b class="b11">내 글에 반응</b>
                                </div>
                            </div>
                            <div class="text6">
                                <div class="div5">오후 3:45</div>
                            </div>
                        </div>
                        <div class="paragraph">
                            <div class="div10">김티슈님이 '사이드 프로젝트 꿀팁 공유합니다' 글을 좋아합니다.</div>
                        </div>
                    </div>
                </div>
                <img class="button-icon4" alt="">
            </div>

            <div class="container42">
                <div class="container36">
                    <div class="container21">
                        <div class="container22">
                            <div class="image"></div>
                        </div>
                        <div class="container-icon2" alt="">
                            <img src="../img/notification4.svg">
                        </div>
                    </div>
                    <div class="container39">
                        <div class="container17">
                            <div class="container48">
                                <div class="heading-35">
                                    <b class="b2">새로운 댓글</b>
                                </div>
                            </div>
                            <div class="text6">
                                <div class="div5">오전 10:20</div>
                            </div>
                        </div>
                        <div class="paragraph">
                            <div class="div12">박디자이너님이 회원님의 글에 댓글을 남겼습니다: "정말 유용한 정보네요! 감사합니다."</div>
                        </div>
                    </div>
                </div>
                <img class="button-icon4" alt="">
            </div>
        </div>

        <!-- 11.23 알림 -->
        <div class="container49">
            <div class="container11">
                <b class="div2">11.23 토요일</b>
            </div>
            <div class="container51">
                <div class="container52">
                    <div class="container21">
                        <div class="container22">
                            <div class="image"></div>
                        </div>
                        <div class="container-icon2" alt="">
                            <img src="../img/notification5.svg">
                        </div>
                    </div>
                    <div class="container39">
                        <div class="container17">
                            <div class="text14">
                                <b class="b14">이벤트 당첨</b>
                            </div>
                            <div class="text15">
                                <div class="div13">11.23</div>
                            </div>
                        </div>
                        <div class="paragraph3">
                            <div class="div14">🎉 11월 활동왕 이벤트에 당첨되셨습니다! 상품 수령 정보를 입력해주세요.</div>
                        </div>
                    </div>
                </div>
                <img class="button-icon6" alt="">
            </div>
        </div>
    </div>
</div>

<!-- ✅ 프로젝트 정리 모달 -->
<div id="project-finish-modal-backdrop" class="project-modal-backdrop" style="display:none;">
    <div class="project-modal-inner">
        <iframe
            id="project-finish-modal-iframe"
            class="project-modal-iframe"
            src="07_01_project_finish.php?user=<?= $current_user_id ?>"
            frameborder="0">
        </iframe>
    </div>
</div>

<script>
  // 🔙 뒤로가기 (마이페이지로, 같은 유저 유지)
  var timmateBox = document.getElementById("back-arrow");
  if (timmateBox) {
    timmateBox.addEventListener("click", function () {
      window.history.back();
    });
  }

  // ✅ 프로젝트 완료 알림 클릭 시 모달 열기
  var projectFinishCard    = document.getElementById("project-finish");
  var projectModalBackdrop = document.getElementById("project-finish-modal-backdrop");

  if (projectFinishCard && projectModalBackdrop) {
    projectFinishCard.addEventListener("click", function (e) {
      projectModalBackdrop.style.display = "flex";
      document.body.style.overflow = "hidden"; // 스크롤 잠그기
    });
  }

  // ✅ 07_01에서 보내는 postMessage 받아서 모달 닫기
  window.addEventListener("message", function (event) {
    if (event.data && event.data.action === "closeProjectFinishModal") {
      var modal = document.getElementById("project-finish-modal-backdrop");
      if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "";
      }
    }
  });
</script>
