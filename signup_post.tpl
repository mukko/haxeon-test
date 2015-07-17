<html>
	<head><title>アカウント登録フォーム</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- 正しい情報が入力された場合　-->
	{if $isCorrect}
		こんにちは、{$userName}さん。<br>
		アカウント情報を登録しました。<br>
		ログイン画面に移動します。
		
	<!-- 誤った内容が入力された場合　-->
	{else}
		<font size="70" face="HGP創英角ﾎﾟｯﾌﾟ体">{$errorMassage}</font>
		<p>入力内容に誤りがあります。もう一度入力してください。</p>
		<a href={$preLink}>戻る</a>
	{/if}
	
	</font>
	</body>
	
</html>