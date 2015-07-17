<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/profile.css" />
  <title>Profile</title>
</head>
<font face="ヒラギノ角ゴ Pro W3","メイリオ">
  <div class="container">
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
        <a href={$userURL}></a>
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
    <div class="projects">
      {for $i=0 to $projects|@count-1}
      <div>
        <p class="title">
          <a href={$projects[$i].url} title={$projects[$i].name}>{$projects[$i].name}</a>
        </p>
        {$projects[$i].pv}
      </div>
      {/for}
    </div>
  </div>
</font>
</html>
