<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); 

/**
 * DB Connection
 */
function my_db_conn() {
  $option = [
      PDO::ATTR_EMULATE_PREPARES      => false,
      PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
  ];

  return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}



function my_pop_up_count_select(PDO $conn, array $arr_param) {
  $sql =
    " SELECT            "
    ."  COUNT(*) cnt               "
    ."  FROM             "
    ."         sports_cal    "
    ." WHERE            "
    ."         deleted_at IS NULL "
    ."       AND date = :date "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt -> execute($arr_param);

    if(!$result_flg){
      throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetch()["cnt"];
}



function my_list_select_id(PDO $conn, array $arr_param) {
  $sql =
    " SELECT            "
    ."  * "
    ."  FROM             "
    ."         sports_cal    "
    ." WHERE            "
    ."         deleted_at IS NULL "
    ."       AND date = :date "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt -> execute($arr_param);

    if(!$result_flg){
      throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetchAll();

}



/**
 * Insert 처리
 */
function my_list_insert(PDO $conn, array $arr_param) {
  $sql =
      " INSERT INTO sports_cal ( "
      ."      date "
      ."      ,title "
      ."      ,hour "
      ."      ,minute "
      ."      ,calory "
      ."      ,part "
      ."      ,level "
      ."      ,memo "
      ." ) "
      ." VALUES( "
      ."      :date "
      ."      ,:title "
      ."      ,:hour "
      ."      ,:minute "
      ."      ,:calory "
      ."      ,:part "
      ."      ,:level "
      ."      ,:memo "
      ." ) "
  ;


  $stmt = $conn->prepare($sql);
  $result_flg = $stmt->execute($arr_param);

  if(!$result_flg) {
      throw new Exception("쿼리 실행 실패");
  }

  $result_cnt = $stmt->rowCount();

  if($result_cnt !== 1) {
      throw new Exception("Insert Count 이상");
  }

  return true;
}

function my_list_update(PDO $conn, array $arr_param){
  $sql = 
    " UPDATE "
    ."   sports_cal "
    ." SET "
    ."      date = :date "
    ."      ,title = :title "
    ."      ,hour = :hour "
    ."      ,minute = :minute "
    ."      ,calory = :calory "
    ."      ,part = :part "
    ."      ,level = :level "
    ."      ,memo = :memo "
    ."      ,updated_at = NOW() "
    ." WHERE "
    ."      id = :id "
  ;

  $stmt = $conn->prepare($sql);
  $result_flg = $stmt->execute($arr_param);

  if(!$result_flg) {
    throw new Exception("퀴리 싪행 실패");
  }

  $result_cnt = $stmt->rowCount();

  if($result_cnt !== 1){
    throw new Exception ("Update Count 이상");
  }

  return $stmt->fetchAll();
}