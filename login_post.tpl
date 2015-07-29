<html>
	<head><title>ログイン</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- ログイン時はアカウント名とサービスを表示　-->
	{if $isLogin}
		ログイン成功です！<br>
		こんにちは、{$userName} さん！
		
	<!-- 未ログイン時はログインとサインアップのリンクを表示　-->
	{else}
	<h1>{$errorMsg}</h1>
	<a href={$preLink}>戻る</a>
	{/if}
	
	</font>
	</body>
	
</html>