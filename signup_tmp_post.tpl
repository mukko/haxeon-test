<html>
	<head><title>アカウント登録フォーム</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- 正しい情報が入力された場合　-->
	{if $isCorrect}
		メールが送信されました。<br>
		メールに記載されてあるURLリンクにアクセスすると、登録が完了します。
		
	<!-- 誤った内容が入力された場合　-->
	{else}
		<font size="70" face="メイリオ">{$errorMassage}</font>
		<p>入力内容に誤りがあります。もう一度入力してください。</p>
		<a href={$preLink}?id={$userID}&mail={$userMail}>戻る</a>
	{/if}
	
	</font>
	</body>
	
</html>