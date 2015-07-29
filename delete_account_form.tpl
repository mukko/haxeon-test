<html>
	<head><title>アカウント削除確認</title></head>

	<form action="delete_account_post.php" method="post">
		<body>
			<font face="ヒラギノ角ゴ Pro W3","メイリオ">
				本当にアカウントを削除しますか？<br>
				アカウントに登録されているプロジェクトはすべて削除されます。<br>
				削除する場合はパスワードを入力してください。<br><br>
				
				<tr>パスワード<br>
				<INPUT size="20" type="password" value="" name="userPass" style="font-size:30;width:500px;height:50px;background-color:#FFFFFF;"></INPUT><br></tr>
				<br><br><br><br>
				<input type="submit" value=@{$userID}を削除 style="font-size:30;width:500px;height:50px;background-color:red;">
				<br><br>
				<input type="button" onclick="location.href='index.php' "value="キャンセル" style="font-size:30;width:500px;height:50px;background-color:skyblue;">
				</font>
		</body>
	</form>

</html>