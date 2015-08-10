<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<div class="container">
	<div class="main">
		<div class="hotcode">
			<font size="10">Hot Codes</font><br>
			
			表示範囲
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days=day">1日以内</a>
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days=week">1週間以内</a>
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days=all">すべて</a><br>
			
			並べ替え
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days={$days}">閲覧回数</a>
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days={$days}">お気に入り数</a>
			<a href="http://localhost/haxeon/index.php?order=pv&page=1&days={$days}">フォーク数</a><br>
			
			ページ
			{if {$page} != 1} <!-- 1ページ目で無ければPREVリンクを表示-->
				<a href="http://localhost/haxeon/index.php?order=pv&page={$page-1}&days={$days}">PREV</a>
			{/if}	
			
			{for $i=$page-2 to $page+2}
				{if {$i} == {$maxPage}} {break} {/if}	<!--最後のページにになったらループを抜ける-->
				
				{if {$i} != -1 && {$i} != 0}
					{if {$i} == {$page}}
						{$i} <!-- 現在表示しているページへのリンクは表示させない-->
					{else}
						<a href="http://localhost/haxeon/index.php?order=pv&page={$i}&days={$days}">{$i}</a>
					{/if}
				{/if}
			{/for}
			
			{if {$page} != {$maxPage}} <!-- 最終ページで無ければNEXTリンクを表示-->
				<a href="http://localhost/haxeon/index.php?order=pv&page={$page+1}&days={$days}">NEXT</a>
			{/if}	
			
			
			<!-- コードランキングの表示 -->
			<div class="projectContainer">
				{for $i=0 to $proNum-1}
				{if {$i} == 30} {break} {/if}
				
				<!-- プロジェクト情報表示 -->
				<div class="project">
					第 {$top+$i+1} 位
					<div class="proName">
						<a href={$var[$i].url}> {$var[$i].proName} </a>
					</div>
					<div class="userName">
						author:	<a href="profile.php?id={$var[$i].userID}">@{$var[$i].userID}</a>
					</div>
					<div class-"pv">
						{$var[$i].pv} view
					</div>
				</div>
				{/for}
			</div>

		</div>
	</div>
	{include file="footer.tpl"}
</div>
</html>
