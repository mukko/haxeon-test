<html>
	<head><title>Create Project</title></head>

	<body>
	<font face="ヒラギノ角ゴ Pro W3","メイリオ">

	<!-- ログイン時はアカウント名とサービスを表示　-->
	{if $isLogin}
		{$projectName}のページを生成中です...

	<!-- 未ログイン時はログインとサインアップのリンクを表示　-->
	{else}
	<p>プロジェクト名が重複しています。</p>
  <p>プロジェクト名は重複しないようにしてください。</p>
	<a href={$preLink}>戻る</a>
	{/if}

	</font>
	</body>

</html>
