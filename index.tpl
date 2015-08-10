<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<div class="container">
	<div class="main">
		<div class="hotcode">
			<font size="10">Hot Codes</font>

			<div class="projectContainer">
				{for $i=0 to $proNum-1}
				<!-- 表示するプロジェクトランキングは5個まで -->
				{if {$i} == 30} {break} {/if}

				<!-- プロジェクト情報表示 -->
				<div class="project">
					第 {$i+1} 位
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
