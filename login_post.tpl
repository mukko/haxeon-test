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
	<p>ログイン失敗です。もう一度入力してください。</p>
	<a href={$preLink}>戻る</a>
	{/if}
	
	</font>
	</body>
	
</html>