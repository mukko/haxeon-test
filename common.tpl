<html>
	<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<title>Haxe on!</title>
	</head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- ヘッダー -->
	<div id="header"><h1><a href={$commonURL}>Haxe On!</a></h1></div>

	<!-- タブリスト　-->
	<div class="menu">
	<ul>
	<!-- ログイン時はアカウント名とサービスを表示　-->
	{if $isLogin}
		<li><h3>Hello, <img src={"img/icon/icon1.jpg"} width=50% height=100%> {$userName}</h3>
			<ul>
				<li><a href={$commonURL}profile.php>Profile</a></li>
				<li><a href="#">Posted Codes</a></li>
				<li><a href="#">Favorite Codes</a></li>
				<li><a href="#">Followers</a></li>
				<li><a href={$commonURL}logout.php>Logout</a></li>
			</ul>
		</li>
	<!-- 未ログイン時はログインとサインアップのリンクを表示　-->
	{else}
		<li><a href={$commonURL}login_form.php>Login</a>
			<ul>
				<li><a href={$commonURL}signup.html>Signup</a></li>
			</ul>
		</li>
	{/if}
		<li>Ranking
			<ul>
				<li><a href="#">Page View Ranking</a></li>
				<li><a href="#">Favorite Ranking</a></li>
				<li><a href="#">Forked Count Ranking</a></li>
			</ul>
		</li>

		<li>Create Code
			<ul>
				<li><a href={$commonURL}try-haxe/index.html>Try-haxe</a></li>
				<li><a href={$commonURL}createProject.html>Create Project</a></li>
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
	</font>
	</body>
</html>
