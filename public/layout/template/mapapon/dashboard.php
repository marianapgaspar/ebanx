<html lang="en" data-reactroot="">
  <head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta charset="utf-8">
    <title>Dashboard UI Kit 3.0 Demo &amp; Docs</title>
    <meta content="Demo previews and React documentation for the best selling Dashboard UI Kit" name="description">
    <meta content="Dashboard UI Kit 3.0 Demo &amp; Docs" property="og:title">
    <meta content="website" property="og:type">
    <meta content="http://preview.janlosert.com" property="og:url">
    <meta content="http://preview.janlosert.com/OGDocumentation.jpg" property="og:image">
    <meta content="Demo previews and React documentation for the best selling Dashboard UI Kit"
        property="og:description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <?php foreach($css as $link) { ?>
      <link rel="stylesheet" media="all" href="<?= $link?>">
    <?php } ?>
    <?php foreach($js as $link) { ?>
      <script src="<?= $link?>"></script>
    <?php } ?>
    <link async="" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
  </head>
  <body>
    <div id="root">
      <div class="uik-App__app">
        <div class="uik-Navigator__wrapper">
          <button class="uik-Navigator__expandButton" type="button"><i class="uikon">view_list</i></button>
          <div class="uik-Navigator__list"><a class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/"><span
              class="uik-nav-link__text"><span class="uik-nav-link__icon"><i
              class="uikon">gallery_grid_view</i></span>Screen Previews</span></a><a class="uik-nav-link__wrapper
              uik-nav-link__wrapperDark" href="/docs"><span class="uik-nav-link__text"><span
              class="uik-nav-link__icon"><i class="uikon">rocket</i></span>Getting Started</span></a><a
              class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/docs/react"><span
              class="uik-nav-link__text"><span class="uik-nav-link__icon"><i class="uikon">help</i></span>React
              Docs</span></a><a class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/docs/changelog"><span
              class="uik-nav-link__text"><span class="uik-nav-link__icon"><i
              class="uikon">multitasking</i></span>Changelog</span></a><a class="uik-nav-link__wrapper
              uik-nav-link__wrapperDark" href="/docs/support"><span class="uik-nav-link__text"><span
              class="uik-nav-link__icon"><i class="uikon">lightbulb</i></span>Support</span></a><a
              class="uik-nav-link__wrapper uik-nav-link__wrapperDark active"
              href="https://janlosert.com/store/dashboard-ui-kit-3.html?from=docs"><span
              class="uik-nav-link__text"><span class="uik-nav-link__icon"><i class="uikon">love</i></span>Download
              kit</span></a></div>
        </div>
        <div class="uik-container-h__wrapper">
          <div class="uik-nav-panel__wrapper uik-buildings-navigation__wrapper uik-buildings__buildingsMenuAnimate">
            <div class="uik-container-v__container">
              <div class="uik-top-bar__wrapper uik-buildings-navigation__topBar">
                <div class="uik-top-bar-section__wrapper">
                  <h2 class="uik-top-bar-title__wrapper uik-buildings-navigation__title">

                  <img style="width:58px;margin-right:15px" src="<?= url()->toRoute('public/common/img/logo.png')?>"> mapapon
                  </h2>
                </div>
              </div>
              <div class="uik-scroll__wrapper uik-buildings-navigation__content"><section
                  class="uik-nav-section__wrapper"><span class="uik-nav-section-title__wrapper">Menu</span><a
                  class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/buildings/dashboard"><span
                  class="uik-nav-link__text">Dashboard</span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/listing"><span
                  class="uik-nav-link__text">Buildings</span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/posts"><span class="uik-nav-link__text">Posts</span></a><a
                  class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/buildings/conversations"><span
                  class="uik-nav-link__text">Conversations</span><span class="uik-nav-link__rightEl"><span
                  class="uik-buildings-navigation__navCount">2</span></span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/amenities"><span
                  class="uik-nav-link__text">Amenities</span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/tenants"><span
                  class="uik-nav-link__text">Tenants</span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/performance"><span
                  class="uik-nav-link__text">Performance</span></a><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/users"><span
                  class="uik-nav-link__text">Users</span></a></section><section class="uik-nav-section__wrapper"><span
                  class="uik-nav-section-title__wrapper">Support</span><a class="uik-nav-link__wrapper
                  uik-nav-link__wrapperDark" href="/buildings/help"><span class="uik-nav-link__text">Need
                  Help?</span></a><a class="uik-nav-link__wrapper uik-nav-link__wrapperDark"
                  href="/buildings/contact"><span class="uik-nav-link__text">Contact Us</span></a><a
                  class="uik-nav-link__wrapper uik-nav-link__wrapperDark" href="/buildings/knowledge-base"><span
                  class="uik-nav-link__text">Knowledge Base</span></a></section></div>
              <a class="uik-buildings-navigation__userContainer" href="/buildings/user/settings">
                <div class="uik-avatar__wrapper">
                  <div class="uik-avatar__avatarWrapper"><img alt="" class="uik-avatar__avatar"
                      src="./static/media/a07.f7e8bebd.jpg"></div>
                  <div class="uik-avatar__info">
                    <div class="uik-avatar__name"><span class="uik-buildings-navigation__avatarName">Kara
                        Johnson</span></div>
                    <div class="uik-avatar__textBottom">HR Specialist</div>
                  </div>
                </div>
                <i class="uikon uik-buildings-navigation__dropdownIcon">dropdown_arrow</i>
              </a>
              <div class="uik-buildings-navigation__aboutAppContainer">
                <div class="uik-buildings-navigation__copyright">© Buildings Ltd. 2018</div>
                <div class="uik-buildings-navigation__copyAbout">Created with love for the environment. By designers and
                    develodivers who love to work together in offices!</div>
              </div>
            </div>
          </div>
          <div class="uik-container-v__container uik-buildings__buildingsMenuAnimate">
            <div class="uik-container-v__container">
              <div class="uik-top-bar__wrapper uik-buildings-top-bar__wrapper">
                <button class="uik-btn__base uik-btn__transparent uik-buildings-top-bar__menuButton" type="button">
                  <span class="uik-btn__content">
                    <div class="uik-nav-icon__wrapper"><svg fill="currentColor" version="1.1" viewbox="0 0 14 2"
                        class="uik-nav-icon__a"><g id="Icon/20px/menu-[Extra]" transform="translate(0.000000,
                        -2.000000)"><polygon id="Path" points="0 4 14 4 14 2 0 2"></g></svg><svg fill="currentColor"
                        version="1.1" viewbox="0 0 20 2" class="uik-nav-icon__b"><g id="Icon/20px/menu-[Extra]"
                        transform="translate(0.000000, -9.000000)"><polygon id="Path" points="0 11 20 11 20 9 0
                        9"></g></svg><svg fill="currentColor" version="1.1" viewbox="0 0 14 2"
                        class="uik-nav-icon__c"><g id="Icon/20px/menu-[Extra]" transform="translate(0.000000,
                        -2.000000)"><polygon id="Path" points="0 4 14 4 14 2 0 2"></g></svg></div>
                  </span>
                </button>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/menu.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Menu</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <button style="display:flex;align-items: center;background-color:#61F618 ;border-radius: 24px;border: 0px;padding:8px 16px 8px 16px"><img style="width:26px;margin-right:10px;height:22px" src="<?= url()->toRoute("public/common/img/map.svg")?>">O MAPA</button>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <button style="display:flex;align-items: center;background-color:#61F618 ;border-radius: 24px;border: 0px;padding:8px 16px 8px 16px"><img style="width:26px;margin-right:10px;height:22px" src="<?= url()->toRoute("public/common/img/lista.svg")?>">LISTA</button>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Vendas</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Serviço</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Locação</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Videos</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/rosa_dos_ventos.svg")?>">
                  </a>
                
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/maioridade.svg")?>">
                  </a>
                
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/cifrao.svg")?>">
                  </a>
                
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/relogio.svg")?>">
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:20px" src="<?= url()->toRoute("public/common/img/filtro.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">Filtro</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <div class="search"><img style="height:16px" src="<?= url()->toRoute("public/common/img/cam.svg")?>"></div>
                  <input placeholder="Pesquisar..." class="search">
                  <a class="search"><img style="height:16px" src="<?= url()->toRoute("public/common/img/search.svg")?>"></a>
                  <div class="search"><img style="height:16px" src="<?= url()->toRoute("public/common/img/cam.svg")?>"></div>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">FRETE</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/vendas.svg")?>">
                    <h2 class="uik-top-bar-title__wrapper">MEU PONTO</h2>
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/bell.svg")?>">
                  </a>
                </div>
                <div class="uik-top-bar-section__wrapper">
                  <a style="    text-align: center;padding:10px">
                    <img style="width:26px" src="<?= url()->toRoute("public/common/img/bell.svg")?>">
                  </a>
                </div>
              </div>
           
              <div class="uik-layout-main__wrapper">
                <?=$contents?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script><?=$scripts?></script>
  </body>
</html>