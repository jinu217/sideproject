<?php
require_once __DIR__.'/config.php';

$action = $_GET['a'] ?? $_POST['a'] ?? '';

if ($action==='ping') j(['ok'=>true,'pong'=>true]);

switch ($action){

  /* ================= 상태 / 유저 ================= */
  case 'state': {
    $uid   = current_user_id();
    $users = q("SELECT user_id,nickname,trust_score,ratings_count FROM `user` ORDER BY user_id")
             ->get_result()->fetch_all(MYSQLI_ASSOC);
    j(['ok'=>true,'current_user_id'=>$uid,'users'=>$users]);
  }

  case 'switch_user': {
    $uid = intval($_POST['user_id'] ?? 1);
    q("UPDATE app_state_current_user SET user_id=? WHERE singleton_id=1",[$uid]);
    j(['ok'=>true,'current_user_id'=>$uid]);
  }

  /* ================= 프로필 ================= */
  case 'get_profile': {
    $uid = intval($_GET['user_id'] ?? current_user_id());
    $u   = q("SELECT user_id,nickname,intro,profile_image,trust_score,ratings_count FROM `user` WHERE user_id=?",[$uid])->get_result()->fetch_assoc();
    if (!$u) j(['ok'=>false,'error'=>'존재하지 않는 사용자']);
    $pos = q("SELECT p.position_id,p.name FROM user_position up JOIN `position` p ON p.position_id=up.position_id WHERE up.user_id=?",[$uid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $tools = q("SELECT t.tool_id,t.kind,t.name FROM user_tool ut JOIN tool t ON t.tool_id=ut.tool_id WHERE ut.user_id=?",[$uid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $badges= q("SELECT b.code,b.name,ub.awarded_at FROM user_badge ub JOIN badge b ON b.badge_id=ub.badge_id WHERE ub.user_id=? ORDER BY ub.awarded_at DESC",[$uid])->get_result()->fetch_all(MYSQLI_ASSOC);
    j(['ok'=>true,'profile'=>$u,'positions'=>$pos,'tools'=>$tools,'badges'=>$badges]);
  }

  case 'update_profile': {
    $uid = current_user_id();
    $nickname = trim($_POST['nickname'] ?? '');
    $intro    = trim($_POST['intro'] ?? '');
    $img      = trim($_POST['profile_image'] ?? '');
    if ($nickname==='') j(['ok'=>false,'error'=>'닉네임 필수']);
    q("UPDATE `user` SET nickname=?, intro=?, profile_image=? WHERE user_id=?",[$nickname,$intro,$img,$uid]);
    j(['ok'=>true]);
  }

  /* ================= 마스터 ================= */
  case 'master': {
    $domains  = q("SELECT domain_id,name FROM domain ORDER BY domain_id")->get_result()->fetch_all(MYSQLI_ASSOC);
    $purposes = q("SELECT purpose_id,name FROM purpose ORDER BY purpose_id")->get_result()->fetch_all(MYSQLI_ASSOC);
    $positions= q("SELECT position_id,name FROM `position` ORDER BY position_id")->get_result()->fetch_all(MYSQLI_ASSOC);
    $tools    = q("SELECT tool_id,kind,name FROM tool ORDER BY kind,name")->get_result()->fetch_all(MYSQLI_ASSOC);
    j(['ok'=>true,'domain'=>$domains,'purpose'=>$purposes,'position'=>$positions,'tool'=>$tools]);
  }

  /* ================= 프로젝트 목록/상세 ================= */
  case 'list_projects': {
    $rows = q("SELECT * FROM v_project_list ORDER BY created_at DESC")->get_result()->fetch_all(MYSQLI_ASSOC);
    j(['ok'=>true,'projects'=>$rows]);
  }

  case 'project_detail': {
    $pid = intval($_GET['project_id'] ?? 0);
    $viewer = current_user_id();

    $p = q("SELECT p.*, u.nickname AS leader_nickname,u.trust_score AS leader_trust
            FROM project p JOIN `user` u ON u.user_id=p.leader_id WHERE p.project_id=?",[$pid])
            ->get_result()->fetch_assoc();
    if (!$p) j(['ok'=>false,'error'=>'프로젝트 없음']);

    $d  = q("SELECT d.name FROM project_domain pd JOIN domain d ON d.domain_id=pd.domain_id WHERE pd.project_id=?",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $pu = q("SELECT pu.name FROM project_purpose pp JOIN purpose pu ON pu.purpose_id=pp.purpose_id WHERE pp.project_id=?",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $t  = q("SELECT t.kind,t.name FROM project_tool_need ptn JOIN tool t ON t.tool_id=ptn.tool_id WHERE ptn.project_id=?",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $needs = q("SELECT pos.name AS position, n.needed_count,
               (SELECT COUNT(*) FROM project_member pm WHERE pm.project_id=n.project_id AND pm.position_id=n.position_id AND pm.status='ACCEPTED') AS accepted_count
               FROM project_position_need n JOIN `position` pos ON pos.position_id=n.position_id
               WHERE n.project_id=?",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);
    $members = q("SELECT pm.user_id, pm.role, pm.status, COALESCE(pos.name,'') AS position_name, u.nickname, u.trust_score
                  FROM project_member pm
                  LEFT JOIN `position` pos ON pos.position_id=pm.position_id
                  JOIN `user` u ON u.user_id=pm.user_id
                  WHERE pm.project_id=?
                  ORDER BY (pm.role='LEADER') DESC, pm.user_id",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);

    $my = q("SELECT status FROM project_member WHERE project_id=? AND user_id=? LIMIT 1",[$pid,$viewer])->get_result()->fetch_assoc();
    $viewer_info = [
      'user_id'   => $viewer,
      'is_leader' => intval($p['leader_id']) === intval($viewer),
      'my_status' => $my['status'] ?? null,
      'can_edit'  => (intval($p['leader_id']) === intval($viewer)) && ($p['status']!=='COMPLETED')
    ];

    j(['ok'=>true,'project'=>$p,'domains'=>$d,'purposes'=>$pu,'tools'=>$t,'needs'=>$needs,'members'=>$members,'viewer'=>$viewer_info]);
  }

  /* ================= 프로젝트 생성/수정 ================= */
  case 'create_project': {
    $leader  = current_user_id();
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title==='') j(['ok'=>false,'error'=>'제목 필수']);

    q("INSERT INTO project (leader_id,title,content) VALUES (?,?,?)",[$leader,$title,$content]);
    global $mysqli; $pid = $mysqli->insert_id;

    // 리더 자동 멤버 등록
    q("INSERT INTO project_member(project_id,user_id,role,status,decided_at) VALUES (?,?, 'LEADER','ACCEPTED', NOW(6))",[$pid,$leader]);

    foreach ((array)($_POST['domain_ids'] ?? []) as $id)
      q("INSERT INTO project_domain(project_id,domain_id) VALUES(?,?)",[$pid,intval($id)]);
    foreach ((array)($_POST['purpose_ids'] ?? []) as $id)
      q("INSERT INTO project_purpose(project_id,purpose_id) VALUES(?,?)",[$pid,intval($id)]);
    foreach ((array)($_POST['tool_ids'] ?? []) as $id)
      q("INSERT INTO project_tool_need(project_id,tool_id) VALUES(?,?)",[$pid,intval($id)]);

    if (!empty($_POST['needs_json'])){
      $needs = json_decode($_POST['needs_json'], true) ?? [];
      foreach ($needs as $n){
        q("INSERT INTO project_position_need(project_id,position_id,needed_count) VALUES(?,?,?)",
          [$pid, intval($n['position_id']), intval($n['needed_count'])]);
      }
    }
    j(['ok'=>true,'project_id'=>$pid]);
  }

  /* ✨ 새로 추가: 프로젝트 수정(리더 전용) */
  case 'update_project': {
    $leader = current_user_id();
    $pid    = intval($_POST['project_id'] ?? 0);
    if ($pid<=0) j(['ok'=>false,'error'=>'project_id 필요']);

    $own = q("SELECT status FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_assoc();
    if (!$own) j(['ok'=>false,'error'=>'리더만 수정 가능']);
    if ($own['status']==='COMPLETED') j(['ok'=>false,'error'=>'완료된 프로젝트는 수정 불가']);

    $title   = isset($_POST['title'])   ? trim($_POST['title'])   : null;
    $content = isset($_POST['content']) ? trim($_POST['content']) : null;

    if ($title!==null)   q("UPDATE project SET title=?   WHERE project_id=?",[$title,$pid]);
    if ($content!==null) q("UPDATE project SET content=? WHERE project_id=?",[$content,$pid]);

    // 옵션: 연관 테이블 전체 교체(전달된 경우에만)
    if (isset($_POST['domain_ids'])) {
      q("DELETE FROM project_domain WHERE project_id=?",[$pid]);
      foreach ((array)($_POST['domain_ids'] ?? []) as $id)
        q("INSERT INTO project_domain(project_id,domain_id) VALUES(?,?)",[$pid,intval($id)]);
    }
    if (isset($_POST['purpose_ids'])) {
      q("DELETE FROM project_purpose WHERE project_id=?",[$pid]);
      foreach ((array)($_POST['purpose_ids'] ?? []) as $id)
        q("INSERT INTO project_purpose(project_id,purpose_id) VALUES(?,?)",[$pid,intval($id)]);
    }
    if (isset($_POST['tool_ids'])) {
      q("DELETE FROM project_tool_need WHERE project_id=?",[$pid]);
      foreach ((array)($_POST['tool_ids'] ?? []) as $id)
        q("INSERT INTO project_tool_need(project_id,tool_id) VALUES(?,?)",[$pid,intval($id)]);
    }
    if (isset($_POST['needs_json'])) {
      q("DELETE FROM project_position_need WHERE project_id=?",[$pid]);
      $needs = json_decode($_POST['needs_json'], true) ?? [];
      foreach ($needs as $n){
        q("INSERT INTO project_position_need(project_id,position_id,needed_count) VALUES(?,?,?)",
          [$pid, intval($n['position_id']), intval($n['needed_count'])]);
      }
    }

    j(['ok'=>true]);
  }

  /* ================= 신청/결정/상태 ================= */
  case 'apply_project': {
    $pid = intval($_POST['project_id'] ?? 0);
    $uid = current_user_id();
    $pos = intval($_POST['position_id'] ?? 0);
    q("INSERT INTO project_member(project_id,user_id,role,position_id,status)
       VALUES (?,?, 'MEMBER', ?, 'APPLIED')
       ON DUPLICATE KEY UPDATE position_id=VALUES(position_id), status='APPLIED', applied_at=NOW(6), decided_at=NULL",
       [$pid,$uid,$pos]);
    j(['ok'=>true]);
  }

  /* ✨ 새로 추가: 신청 취소(본인/상태=APPLIED) */
  case 'cancel_apply': {
    $pid = intval($_POST['project_id'] ?? 0);
    $uid = current_user_id();
    q("UPDATE project_member SET status='CANCELED', decided_at=NOW(6)
       WHERE project_id=? AND user_id=? AND status='APPLIED'",[$pid,$uid]);
    j(['ok'=>true]);
  }

  case 'list_applicants': {
    $pid = intval($_GET['project_id'] ?? 0);
    $leader = current_user_id();
    $owner = q("SELECT 1 FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_row();
    if (!$owner) j(['ok'=>false,'error'=>'리더만 조회 가능']);
    $rows = q("SELECT pm.user_id,u.nickname,COALESCE(p.name,'') AS position_name, pm.status
               FROM project_member pm
               LEFT JOIN `position` p ON p.position_id=pm.position_id
               JOIN `user` u ON u.user_id=pm.user_id
               WHERE pm.project_id=? AND pm.role='MEMBER' AND pm.status='APPLIED'",[$pid])->get_result()->fetch_all(MYSQLI_ASSOC);
    j(['ok'=>true,'applicants'=>$rows]);
  }

  case 'decide': {
    $pid = intval($_POST['project_id'] ?? 0);
    $target = intval($_POST['user_id'] ?? 0);
    $decision = ($_POST['decision'] ?? 'REJECTED')==='ACCEPT' ? 'ACCEPTED' : 'REJECTED';
    $leader = current_user_id();
    $owner = q("SELECT 1 FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_row();
    if (!$owner) j(['ok'=>false,'error'=>'리더만 결정 가능']);
    q("UPDATE project_member SET status=?, decided_at=NOW(6) WHERE project_id=? AND user_id=? AND status='APPLIED'",[$decision,$pid,$target]);
    j(['ok'=>true]);
  }

  case 'close_project': {
    $pid = intval($_POST['project_id'] ?? 0);
    $leader = current_user_id();
    $owner = q("SELECT 1 FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_row();
    if (!$owner) j(['ok'=>false,'error'=>'리더만 마감 가능']);
    q("UPDATE project SET status='CLOSED', closed_at=NOW(6) WHERE project_id=? AND status='RECRUITING'",[$pid]);
    j(['ok'=>true]);
  }

  case 'reopen_project': {
    $pid = intval($_POST['project_id'] ?? 0);
    $leader = current_user_id();
    $owner = q("SELECT 1 FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_row();
    if (!$owner) j(['ok'=>false,'error'=>'리더만 재오픈 가능']);
    q("UPDATE project SET status='RECRUITING', closed_at=NULL WHERE project_id=? AND status='CLOSED'",[$pid]);
    j(['ok'=>true]);
  }

  /* ✨ 새로 추가: (마감 상태) 팀원 중도 하차 */
  case 'leave_project': {
    $pid = intval($_POST['project_id'] ?? 0);
    $uid = current_user_id();

    $p = q("SELECT leader_id,status FROM project WHERE project_id=?",[$pid])->get_result()->fetch_assoc();
    if (!$p) j(['ok'=>false,'error'=>'프로젝트 없음']);
    if ($p['status']!=='CLOSED') j(['ok'=>false,'error'=>'마감 상태에서만 하차 가능']);
    if (intval($p['leader_id'])===intval($uid)) j(['ok'=>false,'error'=>'리더는 하차할 수 없습니다.']);

    q("UPDATE project_member SET status='LEFT', decided_at=NOW(6)
       WHERE project_id=? AND user_id=? AND status='ACCEPTED'",[$pid,$uid]);

    j(['ok'=>true]);
  }

  case 'complete_project': {
    $pid = intval($_POST['project_id'] ?? 0);
    $leader = current_user_id();
    $owner = q("SELECT 1 FROM project WHERE project_id=? AND leader_id=?",[$pid,$leader])->get_result()->fetch_row();
    if (!$owner) j(['ok'=>false,'error'=>'리더만 완료 가능']);
    q("UPDATE project SET status='COMPLETED', completed_at=NOW(6) WHERE project_id=? AND status IN ('CLOSED','RECRUITING')",[$pid]);
    j(['ok'=>true]);
  }

  /* ================= 평가 ================= */
  case 'evaluate': {
    $pid     = intval($_POST['project_id'] ?? $_GET['project_id'] ?? 0);
    $ratee   = intval($_POST['ratee_user_id'] ?? $_GET['ratee_user_id'] ?? 0);
    $score   = max(1, min(5, intval($_POST['score'] ?? $_GET['score'] ?? 5)));
    $comment = trim($_POST['comment'] ?? $_GET['comment'] ?? '');
    $rater   = current_user_id();

    if ($pid<=0 || $ratee<=0) j(['ok'=>false,'error'=>'project_id, ratee_user_id 필요']);
    if ($rater === $ratee)    j(['ok'=>false,'error'=>'자기 자신은 평가할 수 없습니다.']);

    $p = q("SELECT leader_id,status FROM project WHERE project_id=?",[$pid])->get_result()->fetch_assoc();
    if (!$p) j(['ok'=>false,'error'=>'프로젝트가 존재하지 않습니다.']);
    if ($p['status']!=='COMPLETED') j(['ok'=>false,'error'=>'프로젝트 완료 후에만 평가 가능']);

    $chk_rater = q(
      "SELECT (
          EXISTS(SELECT 1 FROM project_member 
                 WHERE project_id=? AND user_id=? AND status IN ('ACCEPTED','LEFT'))
          OR EXISTS(SELECT 1 FROM project 
                    WHERE project_id=? AND leader_id=?)
        ) AS ok",
      [$pid, $rater, $pid, $rater]
    )->get_result()->fetch_assoc();

    $chk_ratee = q(
      "SELECT (
          EXISTS(SELECT 1 FROM project_member 
                 WHERE project_id=? AND user_id=? AND status IN ('ACCEPTED','LEFT'))
          OR EXISTS(SELECT 1 FROM project 
                    WHERE project_id=? AND leader_id=?)
        ) AS ok",
      [$pid, $ratee, $pid, $ratee]
    )->get_result()->fetch_assoc();

    if (empty($chk_rater) || intval($chk_rater['ok']) !== 1) j(['ok'=>false,'error'=>'평가자는 이 프로젝트 참여자가 아닙니다.']);
    if (empty($chk_ratee) || intval($chk_ratee['ok']) !== 1) j(['ok'=>false,'error'=>'대상은 이 프로젝트 참여자가 아닙니다.']);

    $dup = q("SELECT 1 FROM project_evaluation WHERE project_id=? AND rater_user_id=? AND ratee_user_id=? LIMIT 1",[$pid,$rater,$ratee])->get_result()->fetch_row();
    if ($dup) j(['ok'=>false,'error'=>'이미 이 대상에 대한 평가를 등록했습니다.']);

    global $mysqli; $mysqli->begin_transaction();
    try{
      q("INSERT INTO project_evaluation(project_id,rater_user_id,ratee_user_id,score,comment)
         VALUES (?,?,?,?,?)",[$pid,$rater,$ratee,$score,$comment]);

      $agg = q("SELECT ROUND(AVG(score),2) AS avg_score, COUNT(*) AS cnt FROM project_evaluation WHERE ratee_user_id=?",[$ratee])->get_result()->fetch_assoc();
      $avg = floatval($agg['avg_score'] ?? 0);
      $cnt = intval($agg['cnt'] ?? 0);
      q("UPDATE `user` SET trust_score=?, ratings_count=? WHERE user_id=?",[$avg,$cnt,$ratee]);

      $mysqli->commit();
      j(['ok'=>true,'message'=>'평가 등록 완료','new_trust'=>['user_id'=>$ratee,'avg'=>$avg,'cnt'=>$cnt]]);
    } catch(Throwable $e){
      $mysqli->rollback();
      j(['ok'=>false,'error'=>'평가 처리 중 오류: '.$e->getMessage()]);
    }
  }

  default: j(['ok'=>false,'error'=>'unknown action']);
}
