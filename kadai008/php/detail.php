<?php
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
$id=$_GET['id'];
// echo $id;
include "funcs.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_test_table WHERE id=".$id);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //   $view .= '<p>';
    //   $view .= '<a href="detail.php?id='.$result["id"].'">';
    //   $view .= $result["name"] . "," . $result["email"] . "<br>";
    //   $view .= '</a>';
    //   $view .= '</P>';
    $name = $result["name"];
    $email = $result["email"];
    $year=$result["year"];
    $company=$result["company"];
    $birthday=$result["birthday"];
   
    $y =$result['y'];
    $m =$result["m"];
    $d =$result["d"];
    
    $sex=$result["sex"];
    $job=$result["job"];
    $experience=$result["experience"];
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規アンケート登録</title>
  <link href="css/test.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="body">

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_all.php"><label for="">データ一覧を見る</label></a><br>
    <a class="navbar-brand" href="index.php"><label for="">更新</label></a>
    </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div id ="haikei">
<form method="post" action="update.php">
  <div class="jumbotron">
  <fieldset>
<legend><label for="">新規入場者登録画面</label></legend>
  
    <table border="1" width="800" bordercolor="#333333">
  <tr><td><label for="">名前</label></td><td><input type="text" name="name" id="name" value = "<?php echo $name; ?>"></td></tr>
  <tr><td><label for="">Email</label></td><td><input type="email" name="email" id="email" value="<?php echo $email; ?>"></td></tr>
  <tr><td><label for="">年齢</label></td><td><input type="text" style="width:50px" name="year" value="<?php echo $year; ?>"><label for="">　歳</label></td></tr>
  <tr><td><label for="">所属会社</label></td><td><input type="text" name="company" value="<?php echo $company; ?>"></td></tr>
  <tr><td><label for="">生年月日</label></td><td><select id = "nengo1" style="width:100px" name = "birth">
                <option value="昭和"><label for="">昭和</label></option>
                <option value="平成"><label for="">平成</label></option>
                </select>
            　<input type="text" id = "birthday-year" style="width:50px" name="birthday-year" value="<?php echo $y; ?>"><label for="">年</label>
           　 <input type="text" id = "birthday-month"style="width:50px" name="birthday-month" value="<?php echo $m; ?>"><label for="">月</label>
           　 <input type="text" id = "birthday-day" style="width:50px" name="birthday-day" value="<?php echo $d; ?>"><label for="">日</label> </td></tr>
  <tr><td><label for="">性別</label></td><td><select id = "sex" style="width:100px" name="sex" >
                <option value="<?php echo $sex; ?>"><label for=""><?php echo $sex; ?></label></option>
                <option value="<?php echo $sex; ?>"><label for=""><?php echo $sex; ?></label></option>
                </select></td></tr>
  <tr><td><label for="">職種</label></td><td><input type="text" name="job" value="<?php echo $job; ?>"></td></tr><br>
  <tr><td><label for="">経験年数</label></td><td><input type="text" style="width:50px" name="experience" value="<?php echo $experience; ?>"><label for="">　年</label></td></tr>
     </table>
     <input type="hidden" name = "id" value="<?php echo $id; ?>">
     <input type="submit" value="送信"><br>
     </fieldset>
  </div>

<!-- </form>
<form action="select_all.php" method="post" >
<fieldset>
<legend><label for="">会社名で検索</label></legend>
<label><label for="">会社名：</label><input type="text" name="keyword"></label>
 <input type="submit" value="検索"　width=100>
 </fieldset>
    </form> -->
    </div>
<!-- Main[End] -->


</body>
</html>
<!-- 
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>

<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name" value="<?php echo $name; ?>"></label><br>
     <label>Email：<input type="text" name="email" value="<?php echo $email; ?>"></label><br>
     <label>年齢：<input type="text" name="age" value="<?php echo $age; ?>"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"><?php echo $naiyou; ?></textArea></label><br>
     <input type="hidden" name = "id" value="<?php echo $id; ?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>



</body>
</html> -->
