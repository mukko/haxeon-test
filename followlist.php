<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <link type="text/css" href="css/index.css" rel="stylesheet">
  <font face="メイリオ" />
  <title>follow list</title>
</head>
<body>
<!-- DBにつなぐ -->
<!-- フォローしている情報をすべて取得する -->
<!-- それらのアイコンとid,名前を取得 -->
<!-- すべて表示する -->
<div id="header"><h1>Haxe On!</h1></div>

<div class="menu">
<!-- 接続 -->
<!-- ヘッダー -->
<?php
$dbName = 'haxeon';
$user = 'root';
$password = 'koji';

$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
if ($db->connect_error){
  print("connection error" . $db->connect_error . "<br>");
  exit();
}
//未ログイン時はログインとサインアップを表示
if(!isset($_COOKIE["PHPSESSID"])){
?>
<ul>
  <li><a href="http://localhost/haxeon_first/htdocs/login.html">Login</a>
    <ul>
      <li><a href="http://localhost/haxeon_first/htdocs/signup.html">Signup</a></li>
    </ul>
  </li>
<?php
//ログイン時はアカウント名とアカウントサービスを表示
} else {
  //print('セッションIDは'.$_COOKIE["PHPSESSID"].'です。<br>');	//デバッグ
  //ユーザー名からアイコンを取得
  $result =  $db->query("SELECT * FROM `account` WHERE `userID` = \"$_GET[id]\"");
  if($result){
    while($row = $result->fetch_object()){
      //URLに表示するのはuserIDでよいのでは？
      $id = htmlspecialchars($row->userID);
      $icon = htmlspecialchars($row->userIcon);
      $name = htmlspecialchars($row->userName);
      $profile = htmlspecialchars($row->userProfile);
      $url = htmlspecialchars($row->userURL);
      $mail = htmlspecialchars($row->userMail);
    }
  }

?>
<ul>
  <li><h3>Hello, <img src="<?php echo $icon?>" width=10% height=10%> <?php echo "$_GET[id]"?></h3>
    <ul>
      <li><a href="#">Posted Codes</a></li>
      <li><a href="#">Favorite Codes</a></li>
      <li><a href="#">Followers</a></li>
      <li><a href="http://localhost/haxeon_first/htdocs/logout.php">Logout</a></li>
    </ul>
  </li>
<?php } ?>
  <li>Ranking
    <ul>
      <li><a href="#">Page View Ranking</a></li>
      <li><a href="#">Favorite Ranking</a></li>
      <li><a href="#">Forked Count Ranking</a></li>
    </ul>
  </li>

  <li>Create Code
    <ul>
      <li><a href="http://localhost/try-haxe/index.html">Try-haxe</a></li>
      <li><a href="http://localhost/haxeon/createProject.html">Create Project</a></li>
    </ul>
  </li>

  <li>Q&A
    <ul>
      <li><a href="#">New Question</a></li>
      <li><a href="#">Hot Questions</a></li>
    </ul>
  </li>

  <li>About Haxe
    <ul>
      <li><a href="http://api.haxe.org/">Api</a></li>
      <li><a href="https://github.com/HaxeFoundation/haxe">Github</a></li>
      <li><a href="http://sipo.jp/blog/2014/01/25.html">enumのすごさ</a></li>
    </ul>
  </li>

  </ul>
</div>
<!-- ヘッダーおわり -->
<!-- フォローリスト -->
<?php
//followテーブルからuserIDが当てはまる行をすべて取得し、accountテーブルとIDが合致する行を取得
$sql = "SELECT userID, userName, userIcon FROM account WHERE userID IN( SELECT userFollowingID FROM follow WHERE userID IN('$id'))";
$result = $db->query($sql);
if($result){
  while($row = $result->fetch_object()){
    $id = htmlspecialchars($row->userID);
    $icon = htmlspecialchars($row->userIcon);
    $name = htmlspecialchars($row->userName);
  }
}
//echo("<h3>$id</h3><br >");
echo("<div class='info'>");
echo("<img src=$icon><br >");
echo("<h3 class='name'>$name</h3><br >");
echo("</div>");
 ?>
<!-- フォローリストおわり -->
<?php $db->close(); ?>

<!-- フッター -->
<br/><br/>
<div id="footer"><address>Copyright (c) シテイル All Rights Reserved.</address></div>
</font>
</body>
</body>
</html>
