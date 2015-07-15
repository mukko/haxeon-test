<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/profile.css" />
  <title>Profile</title>
</head>

<body>
  <font face="ヒラギノ角ゴ Pro W3","メイリオ">
    <div class="profile">
      <div class="image">
        <img id="icon" src={$userIcon}>
      </div>
      <div class="userName">
        {$userName}
      </div>
      <div class="userId">
        @{$userID}
      </div>
      <hr class="line">
      <div class="userURL">
        URL:
        {if $userURL !== "none"}
        {$userURL}
        {/if}
      </div>
      <div class="userMail">
        mail:
        {if $userMail !== 'none'}
        {$userMail}
        {/if}
      </div>
      <hr class="line">
      <div class="userProfile">
        {if $userProfile !== 'none'}
        {$userProfile}
        {/if}
      </div>
    </div>
    <div class="project">
      {for $i=0 to $projects|@count-1}
      {$projects[$i].id}
      {/for}
    </div>
  </font>
</body>
</html>
