<p>ログイン情報を入力してください。</p>
	
<form action="login_post.php" method="post">
	
	<center>
		<table border="30">
			<tr>
				<td>ID</td>
				<td><input type="text" name="id"></td>
				<td>パスワード</td>
				<td><input type="password" name="pass"></td>
				<td colspan="20" align="center">
				</td>
			</tr>
		</table>
	</center>
	
	<!-- 送信ボタン -->
	<input type="submit" value="ログイン"/>
	
</form>

{include file="footer.tpl"}
