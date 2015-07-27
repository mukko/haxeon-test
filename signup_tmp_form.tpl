<p>仮登録を行います。<br>IDとメールアドレスを入力してください。</p><br>

<form action="signup_tmp_post.php" method="post" enctype="multipart/form-data">
	<center>
		<tr>ID<br>
		<INPUT size="35" type="text" value="{$userID}" name="userID"></INPUT><br></tr>
		<tr>パスワード<br>
		<INPUT size="35" type="password" value="" name="userPass"></INPUT><br></tr>
		<tr>メールアドレス<br>
		<INPUT size="35" type="email" value="{$userMail}" name="userMail"></INPUT><br></tr><br>
	</center> 
	<input type="submit" value="送信" style="font-size:30;width:100px;height:50px" />
</form>