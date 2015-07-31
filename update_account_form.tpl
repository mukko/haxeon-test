<html>
	<head><title>プロフィール編集</title></head>

	<p>更新する項目を入力してください。<br>更新しない項目は空欄のまま保存して下さい。</p><br>

	<form action="signup_post.php" method="post" enctype="multipart/form-data">
		<center>
			<tr>ユーザーID(変更不可)<br>
			<INPUT size="20" type="text" value={$uid} disabled="disabled" name="userID"></INPUT><br></tr>
			<br>
			<tr>現在のパスワード<br>
			<INPUT size="20" type="password" value="" name="currentPass"></INPUT><br></tr>
			<tr>新しいパスワード<br>
			<INPUT size="20" type="password" value="" name="userPass"></INPUT><br></tr>
			<tr>新しいパスワード(確認)<br>
			<INPUT size="20" type="password" value="" name="userPass2"></INPUT><br></tr>
			<br>
			<tr>ユーザー表示名<br>
			<INPUT size="20" type="text" value={$userName} name="userName"></INPUT><br></tr><br>
			<tr>アイコン<br>
			<INPUT type="file" name="userIcon"></INPUT><br></tr><br>
			<tr>プロフィール<br>
			<TEXTAREA rows="5" cols="40" type="text" value={$userProfile} name="userProfile"></TEXTAREA><br></tr>
			<br>
			<tr>URL<br>
			<INPUT size="50" type="url" name="userURL" value={$userURL}></INPUT><br></tr>
		</center>
			<br>
		<input type="submit" value="保存" style="font-size:30;width:100px;height:50px" />
	</form>
</html>
