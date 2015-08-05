<html>

<head> <meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/profile.css" />
<title>Profile</title>
</head>

<font face="ヒラギノ角ゴ Pro W3","メイリオ">
<div class="container">
	<div class="main">

		<!-- プロフィール情報表示部分 -->
		<div class="profile">

			<div class="image">
				<img id="icon" src={$userIcon}>
			</div>

			<!-- ログイン中のIDとプロフィールページのIDが一致しない場合　-->
			{if $userID!=$uid}

				<!--　フォロー中ならアンフォローボタンを表示 -->
				{if $isFollow}
					<div class="unfollowBtn">
						<a href="unfollow.php?id={$userID}">
							<img src="img/unfollowbutton.png" alt="アンフォローボタン">
						</a>
					</div>
				{else}
					<div class="followBtn">
						<a href="follow.php?id={$userID}">
							<img src="img/followbutton.png" alt="フォローボタン">
						</a>
					</div>
				{/if}

			{/if}

			<div class="userName">
				{$userName}
			</div>

			<div class="userId">
				@{$userID}
			</div>

			<hr class="line">

			<div class="userURL">
				URL:<a href={$userURL}>{$userURL}</a>
			</div>

			<div class="userMail">
				Mail:{$userMail}
			</div>

			<hr class="line">

			<div class="userProfile">
				{$userProfile}
			</div>

			<!-- プロフィール設定項目の表示 -->
			{if $userID==$uid}
				<a Href="http://localhost/haxeon/update_account_form.php">プロフィール更新</a>
				<input type="button" style="background-color:red;" onclick="location.href='delete_account_form.php'"value="アカウント削除"></input>
			{/if}

		</div>
		<!-- プロフィール情報表示部分終了 -->

		<!-- 所持プロジェクト一覧 -->
		<div class="contents">
		<div class="projects">
		<div class="boxContainer">
			{for $i=0 to $projects|@count-1}
				<div id={$projects[$i].id} class="box">
				<p class="title">
				<a href={$projects[$i].url} title={$projects[$i].name}>{$projects[$i].name}</a>
				</p>
				<div class="pv">{$projects[$i].pv} pv</div>
                {if  $userID==$uid}
                <div class="edit"><a href="projectSettings.php?pid={$projects[$i].id}">設定</a></div>
                {/if}
				</div>
			{/for}
		</div>
		</div>
		</div>

	</div>

	{include file="footer.tpl"}

</div>
</font>

</html>
