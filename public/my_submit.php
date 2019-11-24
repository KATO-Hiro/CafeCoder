<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>自分の提出</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css" />
    <script src="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.js"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script>
        jQuery(function($) {
            $.extend($.fn.dataTable.defaults, {
                language: {
                    url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
                }
            });
            $("#result-table").DataTable({
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
</head>

<body>
<?php include_once("../template/nav.php");
include_once("../util/util.php");
echo_nav_card($_GET["contest_id"]);
?>

<table class="table table-bordered">
<div class="pager">
<?php 
$page = (isset($_GET["page"]) && $_GET["page"] >= 0)? $_GET["page"] : 0 ;
if(!preg_match("/^[0-9]+$/",$page)){
    echo "PAGE ERROR";
    exit();
}
if($page > 0){
echo '<a href="my_submit.php?page='.((int)$page-1)."&contest_id=".$_GET["contest_id"].'">前へ</a>';
}
echo $page;
echo '<a href="my_submit.php?page='.((int)$page+1).'&contest_id='.$_GET["contest_id"].'">次へ</a>';
?>
</div>
<thead>
    <tr>
        <th>Username</th>
        <th>Date</th>
        <th>Problem</th>
        <th>Result</th>
        <th>Source</th>
    </tr>
</thead>
<tbody>

<?php

$page = (isset($_GET["page"]) && $_GET["page"] >= 0)? $_GET["page"] : 0 ;
if(!isset($_GET["contest_id"])){
    echo "contest_idを指定してください。";
    exit();
}
if(!preg_match("/^[0-9]+$/",$page)){
    echo "PAGE ERROR";
    exit();
}
$contest_id = $_GET["contest_id"];
include_once "../database/connection.php";
$con = new DBC();
$page_from = (int)($page * 50);
$page_to = (int)($page * 50 + 50);

//get result
try{
$rec = $con->prepare_execute("SELECT username, user_id, problem, code_session FROM uploads LEFT JOIN users ON uid=user_id WHERE contest_id=?",array($contest_id));
}catch(Exception $e){
    echo "DB SELECT ERROR 1";
    exit();
}
$all_path = array();
foreach($rec as $line){
    $user_code_path = get_uploaded_session_path($line["username"], $contest_id, $line["problem"], $line["code_session"]).".result";
    if(!file_exists($user_code_path)){
        continue;
    }
    try{
    $fp = fopen($user_code_path,"r");
    $csv = fgetcsv($fp);
    $result = $csv[3];
    }catch(Exception $e){
        echo "csv load error";
    }
    try{
    $con->prepare_execute("UPDATE uploads SET result=? WHERE code_session=?",array($result, $line["code_session"]),array($result));
    }catch(Exception $e){
        echo("DB UPDATE ERROR");
    }
}
try{
    $rec = $con->prepare_execute("SELECT problem, code_session,upload_date,result FROM uploads LEFT JOIN users ON user_id=uid WHERE user_id=? AND contest_id=? ORDER BY upload_date DESC LIMIT 50 OFFSET $page_from",array($_SESSION["uid"],$contest_id));
    // var_dump($rec);
    foreach ($rec as $line) {
        echo '<tr><th>';
        echo $_SESSION["username"];
        echo '</th>';
        echo '<th>';
        echo $line["upload_date"];
        echo '</th>';
        echo '<th>';
        echo $line["problem"];
        echo '</th>';
        echo '<th>';
        echo $line["result"];
        echo '</th>';
        echo '<th>';
        echo '<a href="/result.php?code_session='.$line["code_session"].'&contest_id='.$contest_id.'">提出コード</a>';
        echo '</th></tr>';
    }
}catch(Exception $e){
    var_dump($e);
    echo "DB SELECT ERROR";
}
?>
</tbody>
</table>
<?php
include_once("../util/util.php");
echo_nav_card_footer();
?>
</body>