<html>
<link rel="stylesheet" type="text/css" href="css/followlist.css" />
<head>
  <title>followlist</title>
</head>
<body>
  <div class="container">
    <div class="main">
      <!-- <div class="followlist">
        <h2><p class="title">ふぉろわー</p></h2>
        {if $length > 0}
        {for $i=0 to $length-1}
          <div class="followBox">
            <div class="icon">
              <img src={$followers[$i].icon} width=50px height=50px>
            </div>
            <div class="name">
              <a href={$commonURL}profile.php?id={$followers[$i].id}>{$followers[$i].name}</a>
            </div>
            <div class="id">
              @{$followers[$i].id}
            </div>
          </div>
          {/for}
        {else if}
          <div class="message">
            you have no follower
          </div>
        {/if}
      </div> -->
      <h2><p class="title">ふぉろわー</p></h2>
      <ul class="followlist">
        {if $length > 0}
        {for $i=0 to $length-1}
        <li class="followBox">
          <div class="icon">
            <img src={$followers[$i].icon} width=50px height=50px>
          </div>
          <div class="name">
            <p><a href={$commonURL}profile.php?id={$followers[$i].id}>{$followers[$i].name}</a></p>
          </div>
          <div class="id">
            <p>@{$followers[$i].id}</p>
          </div>
        </li>
        {/for}
        {else if}
          <div class="message">
            you have no follower
          </div>
        {/if}
      </ul>
    </div>
    {include file="footer.tpl"}
  </div>
</body>
</font>
</html>
