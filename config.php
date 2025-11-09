<?php
// config.php
// XAMPP 기본 설정 기준 (root / 빈 비번)
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'sideproject';
$DB_PORT = 3306;

mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if ($mysqli->connect_errno) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['ok'=>false,'error'=>'DB connect fail','detail'=>$mysqli->connect_error], JSON_UNESCAPED_UNICODE);
  exit;
}
$mysqli->set_charset('utf8mb4');

function j($arr, $code=200){
  http_response_code($code);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  exit;
}
function q($sql, $params=[], $types=''){
  global $mysqli;
  $stmt = $mysqli->prepare($sql);
  if (!$stmt) j(['ok'=>false,'error'=>'prepare: '.$mysqli->error,'sql'=>$sql],500);
  if ($params){
    if ($types===''){
      foreach($params as $p){
        $types .= (is_int($p) || is_float($p)) ? 'i' : 's';
      }
    }
    $stmt->bind_param($types, ...$params);
  }
  if (!$stmt->execute()){
    j(['ok'=>false,'error'=>'execute: '.$stmt->error,'sql'=>$sql,'params'=>$params],500);
  }
  return $stmt;
}
function current_user_id(){
  $r = q("SELECT user_id FROM app_state_current_user WHERE singleton_id=1")->get_result()->fetch_assoc();
  return intval($r['user_id'] ?? 1);
}
