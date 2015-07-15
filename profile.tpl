<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/profile.css" />
  <title>Profile</title>
</head>

<body>
  <font face="メイリオ">
    <div>
      <div class="image">
        <img src={$userIcon}>
      </div>
      <div class="userName">
        {$userName}
      </div>
      <div class="userId">
        {$userID}
      </div>
      <div class="userURL">
        {if $userURL !== "none"}
          {$userURL}
        {/if}
      </div>
      <div class="userMail">
        {if $userMail !== 'none'}
          {$userMail}
        {/if}
      </div>
      <div class="userProfile">
        {if $userProfile !== 'none'}
          {$userProfile}
        {/if}
      </div>
    </div>
  </font>
</body>
</html>
