<!DOCTYPE html>
<html>
	<div class="hotcode">
	<font size="10">Hot Codes</font><br>

	{for $i=0 to $proNum-1}
		<!-- 表示するプロジェクトランキングは5個まで -->
		{if {$i} == 5} {break} {/if}

		<!-- プロジェクト情報表示 -->
		第 {$i+1} 位　:
		<a href={$var[$i].url}> {$var[$i].proName} </a> |
		<!-- 追加部分:urlは暫定です -->
		<a href="profile/{$var[$i].userID}">{$var[$i].userName}</a> |
		{$var[$i].pv}view!! <br>

	{/for}

	<!-- フッター -->
	<br/><br/>
	<div id="footer"><address>Copyright (c) シテイル All Rights Reserved.</address></div>
	</div>
	</font>
</html>
