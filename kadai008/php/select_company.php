


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<!-- <link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/hyoji.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録に戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<table border="1" width="500" cellspacing="0" cellpadding="5" bordercolor="#333333">
<tr><th>更新ボタン</th><th>名前</th><th>Email</th><th>年齢</th><th>所属会社</th><th>生年月日</th>
<th>性別</th><th>職種</th><th>経験年数</th><th>削除ボタン</th></tr>

<?php

$keyword = $_POST["keyword"];
// echo $keyword;
//1.  DB接続します
try {
$pdo = new PDO('mysql:dbname=gs_test;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ表示SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_test_table WHERE company = '$keyword' ");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
 
    $detail =$result["id"];
   
    $name = $result["name"];
    $email = $result["email"];
    $year=$result["year"];
    $company=$result["company"];
    $birthday=$result["birthday"];
    $sex=$result["sex"];
    $job=$result["job"];
    $experience=$result["experience"];
    $delete =$result["id"];
    echo '<tr>';
    echo '<td>'.'<form action="detail.php" method="post">'.'<input type="hidden" name = "id" value="',$detail,'">'.
    '<input type="submit" value="更新" width="500">'.'</form>'.'</td>';
echo '<td>',$name,'</td>';
echo '<td>',$email,'</td>';
echo '<td>',$year,'</td>';
echo '<td>',$company,'</td>';
echo '<td>',$birthday,'</td>';
echo '<td>',$sex,'</td>';
echo '<td>',$job,'</td>';
echo '<td>',$experience,'</td>';
echo '<td>'.'<form action="delete2.php" method="post">'.'<input type="hidden" name = "id" value="',$delete,'">'.
'<input type="hidden" name = "keyword" value="',$keyword,'">'.
'<input type="submit" value="削除" width="500">'.'</form>'.'</td>';
echo '</tr>';
echo "\r\n";
}
}

?>
</table>
<!-- Main[End] -->

</body>
</html>
