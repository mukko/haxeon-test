<html>
<head><meta charset="utf-8" />
    <title>設定画面</title>
</head>

{*タグ用フォーム*}
<div class="tagform">
<form action="tag_post.php?pid={$pid}" method="post">
    <table border="30">
        <tr>
            <td>タグ名</td>
            <td><input type="text" name="tagName"></td>
            <td colspan="20" align="center"></td>
        </tr>
    </table>
    <input type="submit" value="作成"/>
</form>
</div>
</html>
