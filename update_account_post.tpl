<html>
	<head><title>アカウント登録フォーム</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- 正しい情報が入力された場合　-->
	{if $isCorrect}
		アカウント情報を更新しました。<br>
		<a href="http://localhost/haxeon/profile.php?id={$userName}" >Go Profile Page</a>
		
	<!-- 誤った内容が入力された場合　-->
	{else}
		<font size="70">{$errorMassage}</font>
		<p>入力内容に誤りがあります。もう一度入力してください。</p>
		<a href="http://localhost/haxeon/update_account_form.php?userName={$userName}&userProfile={$userProfile}&userURL={$userURL}" >Go Profile Page</a>
	{/if}
	
	</font>
	</body>
	
</html>