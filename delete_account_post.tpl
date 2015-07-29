<html>
	<head><title>アカウント削除</title></head>

	<body>

	<!-- 正しい情報が入力された場合　-->
	{if $isCorrect}
		アカウントの削除に成功しました。
		トップ画面に遷移します。
		
	<!-- 誤った内容が入力された場合　-->
	{else}
		<font size="70">{$errorMsg}</font>
	{/if}
	
	</body>
	
</html>