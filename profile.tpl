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
      {if $userID!=$uid && !$isFollow}
      <div class="followBtn">
        <a href="follow.php?id={$userID}">
        <img src="img/followbutton.png" alt="フォローボタン">
        </a>
      </div>
      {/if}
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
    <div class="contents">
      <div class="projects">
        <div class="head"><p>Projects</p></div>
          <div class="boxContainer">
          {for $i=0 to $projects|@count-1}
            <div id={$projects[$i].id} class="box">
              <p class="title">
                <a href={$projects[$i].url} title={$projects[$i].name}>{$projects[$i].name}</a>
              </p>
              <span class="pv">{$projects[$i].pv}</span>
            </div>
            {/for}
          </div>
      </div>
    </div>
  </div>
</font>
</html>
