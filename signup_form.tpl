<p>登録するアカウント情報を入力してください。</p><br>

<form action="signup_post.php" method="post" enctype="multipart/form-data">
	<center>
		<tr>ユーザーID<br>
		<INPUT size="20" type="text" value="" name="userID"></INPUT><br></tr>
		<tr>パスワード<br>
		<INPUT size="20" type="password" value="" name="userPass"></INPUT><br></tr>
		<tr>パスワード(確認)<br>
		<INPUT size="20" type="password" value="" name="userPass2"></INPUT><br></tr>
		<tr>ユーザー名<br>
		<INPUT size="20" type="text" value="" name="userName"></INPUT><br></tr><br>
		<tr>アイコン<br>
		<INPUT type="file" name="userIcon"></INPUT><br></tr><br>
		<tr>プロフィール<br>
		<TEXTAREA rows="5" cols="40" type="text" value="" name="userProfile"></TEXTAREA><br></tr>
		<tr>URL<br>
		<INPUT size="50" type="url" value="https://github.com/" name="userURL"></INPUT><br></tr>
		<tr>メールアドレス<br>
		<INPUT size="50" type="email" value="hoge@example.com" name="userMail"></INPUT><br></tr><br>
	</center>
		
	<input type="submit" value="送信" style="font-size:30;width:100px;height:50px" />
</form>

{include file="footer.tpl"}
