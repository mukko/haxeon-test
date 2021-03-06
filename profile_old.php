<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <link type="text/css" href="css/profile.css" rel="stylesheet">
  <font face="HGP創英角ﾎﾟｯﾌﾟ体","ヒラギノ角ゴ Pro W3","メイリオ" />
    <title>profile</title>
  </head>
  <body>
    <div id="wrapper">
      <!-- ページ本体 -->
      <div id="container">
        <!-- ヘッダー -->
        <div class="menu">

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

          $sql = "SELECT COUNT(*) as cnt FROM follow WHERE userFollowingID = $id";
          $follow = 0;
          if($result = $db->query($sql)){
          while($row = $result->mysqli_fetch_assoc()){
            $follow = $row['cnt'];
          }
        }
          echo("<h3>$follow</h3><br >");

          $followed = $db->query("SELECT COUNT(*) FROM `follow` WHERE `userFollowingID` = $id");
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

        <div id="profile">

          <!-- プロフィール -->
          <div id="my_column">
            <div id="column">
              <h1>profile</h1>
              <?php
              echo "<div style='text-align:center;'>";
              if($icon == "none") echo "<img src='../assets/image/empty_thumbnail.png' width=200px height=200px>";
              else echo "<img src=$icon width=200px height=200px>";
              echo "</div>";
              echo "<p>$id</p>";
              echo "<h2>$name</h2>";

              //userURLがあったら表示
              if($url != "none") echo "<p>URL: $url</p>";

              //userMailがあったら表示
              if($mail != "none") echo "<p>Mail: $mail</p>";

              if($profile != "none") echo "<p>Profile $profile</p>";

              echo "<h1>$follow</h1>";
               ?>
            </div>
          </div>
          <!-- コンテンツ -->
          <div id="my_contents">
            <div id="contents">
              <h1>コードの情報が決まったらつくる</h1>
              <p>サムネとか</p>
              <p>なにを表示するのかとか</p>
            </div>
          </div>
          <?php
          $db -> close();
           ?>
        </div>
        <div id="footer">
          footer
        </div>
      </div>

    </div>
</body>
</html>
