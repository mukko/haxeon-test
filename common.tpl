
	<link rel="stylesheet" type="text/css" href="css/common.css" />

	<!-- ヘッダー -->
	<div id="header"><h1><a href={$commonURL}><img src="img/haxeon_icon.png" style="width:auto; height:75px;"></a></h1></div>

	<!-- タブリスト　-->
	<div class="menu">
	<ul>
	<!-- ログイン時はアカウント名とサービスを表示　-->
	{if $isLogin}
		<li><h3>Hello, <img src={$iconURL} width=50% height=100%> {$userName}</h3>
			<ul>
				<li><a href={$commonURL}profile.php?id={$id}>Profile</a></li>
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
				<li><a href={$commonURL}signup_form.php>Signup</a></li>
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

		<li>Code
			<ul>
				<!-- <li><a href={$commonURL}try-haxe/index.html>Try-haxe</a></li> -->
				<li><a href={$commonURL}create_form.php>Create Project</a></li>
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
