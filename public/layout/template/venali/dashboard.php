<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Square timeline</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Page description">
    <!--Twitter Card data-->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Page Title">
    <meta name="twitter:description" content="Page description less than 200 characters">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="http://www.example.com/image.jpg">
    <!--Open Graph data-->
    <meta property="og:title" content="Title Here">
    <meta property="og:type" content="article">
    <meta property="og:url" content="http://www.example.com/">
    <meta property="og:image" content="http://example.com/image.jpg">
    <meta property="og:description" content="Description Here">
    <meta property="og:site_name" content="Site Name, i.e. Moz">
    <meta property="fb:admins" content="Facebook numeric ID">
    <?php foreach($css as $link) { ?>
      <link rel="stylesheet" media="all" href="<?= $link?>">
    <?php } ?>
    <script>var viewportmeta = document.querySelector('meta[name="viewport"]');
if (viewportmeta) {
  if (screen.width < 375) {
    var newScale = screen.width / 375;
    viewportmeta.content = 'width=375, minimum-scale=' + newScale + ', maximum-scale=1.0, user-scalable=no, initial-scale=' + newScale + '';
  } else {
    viewportmeta.content = 'width=device-width, maximum-scale=1.0, initial-scale=1.0';
  }
}</script>
  </head>
  <body>
    <div class="out">
      <div class="page2 js-page2">
        <div class="header2 js-header2"><button class="header2__burger js-header2-burger"><svg class="icon icon-burger">
              <use xlink:href="img/sprite.svg#icon-burger"></use>
            </svg></button><a class="header2__logo" href="#"><img class="header2__pic header2__pic_black" src="img/logo.svg" alt="" /><img class="header2__pic header2__pic_white" src="img/logo-white.svg" alt="" /></a>
          <div class="header2__search"><button class="header2__open"><svg class="icon icon-search">
                <use xlink:href="img/sprite.svg#icon-search"></use>
              </svg></button><input class="header2__input" type="text" placeholder="Search" /></div>
          <div class="header2__group"><button class="header2__link"><svg class="icon icon-friends-request">
                <use xlink:href="img/sprite.svg#icon-friends-request"></use>
              </svg></button><button class="header2__link active js-header2-users"><svg class="icon icon-chat">
                <use xlink:href="img/sprite.svg#icon-chat"></use>
              </svg></button><a class="header2__link header2__link_bell active" href="square-notifications.html"><svg class="icon icon-bell">
                <use xlink:href="img/sprite.svg#icon-bell"></use>
              </svg></a></div><a class="header2__profile" href="square-profile.html"><img class="header2__pic" src="img/ava-1.png" alt="" /></a>
          <div class="header2__bg js-header2-bg"></div>
        </div>
        <div class="page2__wrapper">
          <div class="sidebar2 js-sidebar2">
            <div class="sidebar2__top"><button class="sidebar2__close js-sidebar2-close"><svg class="icon icon-close">
                  <use xlink:href="img/sprite.svg#icon-close"></use>
                </svg></button><a class="sidebar2__logo" href="#"><img class="sidebar2__pic sidebar2__pic_black" src="img/logo.svg" alt="" /><img class="sidebar2__pic sidebar2__pic_white" src="img/logo-white.svg" alt="" /></a></div>
            <div class="sidebar2__wrapper"><a class="sidebar2__profile" href="square-profile.html">
                <div class="ava"><img class="ava__pic" src="img/ava-1.png" alt="" /></div>
                <div class="sidebar2__details">
                  <div class="sidebar2__user">Ahmad Nur Fawaid</div>
                  <div class="sidebar2__login">@fawait</div>
                </div>
              </a>
              <div class="sidebar2__nav"><a class="sidebar2__item active" href="square-timeline.html"><svg class="icon icon-dashboard">
                    <use xlink:href="img/sprite.svg#icon-dashboard"></use>
                  </svg>Dashboard</a><a class="sidebar2__item" href="square-friends.html"><svg class="icon icon-friends">
                    <use xlink:href="img/sprite.svg#icon-friends"></use>
                  </svg>Friends</a><a class="sidebar2__item" href="square-event.html"><svg class="icon icon-event">
                    <use xlink:href="img/sprite.svg#icon-event"></use>
                  </svg>Event<div class="sidebar2__counter">3</div></a><a class="sidebar2__item" href="square-watch-videos.html"><svg class="icon icon-video">
                    <use xlink:href="img/sprite.svg#icon-video"></use>
                  </svg>Watch Videos</a><a class="sidebar2__item" href="square-photos.html"><svg class="icon icon-photo">
                    <use xlink:href="img/sprite.svg#icon-photo"></use>
                  </svg>Photos</a><a class="sidebar2__item" href="#"><svg class="icon icon-file">
                    <use xlink:href="img/sprite.svg#icon-file"></use>
                  </svg>Files</a><a class="sidebar2__item" href="square-marketplace.html"><svg class="icon icon-sale">
                    <use xlink:href="img/sprite.svg#icon-sale"></use>
                  </svg>Marketplace</a></div>
              <div class="sidebar2__box">
                <div class="sidebar2__category">pages you like</div>
                <div class="sidebar2__menu"><a class="sidebar2__link" href="square-group-about.html">
                    <div class="sidebar2__letters" style="background-color: #82C43C;">FF</div>
                    <div class="sidebar2__text">Football FC</div>
                    <div class="sidebar2__counter">120</div>
                  </a><a class="sidebar2__link" href="square-group-about.html">
                    <div class="sidebar2__letters" style="background-color: #A461D8;">BC</div>
                    <div class="sidebar2__text">Badminton Club</div>
                  </a><a class="sidebar2__link" href="square-group-about.html">
                    <div class="sidebar2__letters" style="background-color: #50B5FF;">UI</div>
                    <div class="sidebar2__text">UI/UX Community</div>
                  </a><a class="sidebar2__link" href="square-group-about.html">
                    <div class="sidebar2__letters" style="background-color: #FF9AD5;">WD</div>
                    <div class="sidebar2__text">Web Designer</div>
                  </a></div>
              </div>
            </div><label class="switch switch_theme"><input class="switch__input js-switch-theme" type="checkbox" /><span class="switch__in"><span class="switch__box"></span><span class="switch__icon"><svg class="icon icon-moon">
                    <use xlink:href="img/sprite.svg#icon-moon"></use>
                  </svg><svg class="icon icon-sun">
                    <use xlink:href="img/sprite.svg#icon-sun"></use>
                  </svg></span></span></label>
          </div>
        </div>
      </div>
    </div>
    <?php foreach($js as $link) { ?>
      <script src="<?= $link?>"></script>
    <?php } ?>
    <script><?=$scripts?></script>
  </body>
</html>