<html>
	<head><title>アカウント認証</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- 認証が成功した場合　-->
	{if $isSuccess}
		<font size="70" face="メイリオ">
			認証が成功しました!!<br>
			ログイン画面に移動します。
			<meta http-equiv="refresh" content="3;URL=http://localhost/haxeon/login_form.php">
		</font>
	<!-- 誤った内容が入力された場合　-->
	{else}
		<font size="70" face="メイリオ">{$errorMsg}</font>
	{/if}
	
	</font>
	</body>
	
</html>