<html lang="en"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">

    <!-- Facebook -->
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <link rel="icon" type="image/png" sizes="32x32" href="https://calendario.mercosur.int/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.cardume.digital/public/sites/mercosulmotores/favicons/favicon-16x16.png">

    <title>Mercosul | <?=$title?></title>

    <?php
 
                    use App\Users\Models\Users;
                    use App\Users\Rules\Scopes;

foreach($css as $link) { ?>
      <link rel="stylesheet" media="all" href="<?= $link?>">
    <?php } ?>
    <style>
    /*Esconde a dive de classe Overlay caso seja identificado que o width Mobile maximo deseja igual ou menor que 980px*/
    @media only screen and (max-width: 980px){
        .overlay { display: none; }
    }
</style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href="<?=url()->toRoute('home')?>"><img src='<?=url()->toRoute('public/common/img/logo.png')?>' width="125px"></div></a>
    <div class="br-sideleft overflow-y-auto ps ps--theme_default ps--active-y" data-ps-id="5d6ec77c-3619-a548-c8b4-72bf0277aee4">
      <label class="sidebar-label pd-x-15 mg-t-20"></label>
      <?=$menu?>
      
      
    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        <!-- <div class="input-group hidden-xs-down wd-170 transition">
          <input id="searchbox" type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span> 
        </div> input-group -->
        <div class="pd-10 overlay">
          <ul class="nav nav-pills flex-column flex-md-row justify-content-center" role="tablist">
            <?php if (uri() == '/'){?>
              <li class="nav-item"><a class="nav-link active"  href="<?= url()->toRoute('/')?>" role="tab">Dashboard</a></li>
            <?php } else { ?>
              <li class="nav-item"><a class="nav-link"  href="<?= url()->toRoute('/')?>" role="tab">Dashboard</a></li>
            <?php } ?>
            <!-- more menu here -->
          </ul>
        </div>
      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down"><?=$auth->getName()?></span>
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="<?= url()->toRoute('/users/form/'.Users::instance()->getByName($auth->getName())->id)?>" ><i class="icon ion-ios-person"></i> Editar Perfil</a></li>
                <!-- <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li> -->
                <!-- <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
                <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li> -->
                <li><a href="<?=url()->toRoute("users/sign-out")?>"><i class="icon ion-power"></i> Sair</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      
      </div><!-- br-header-right -->
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
        <?php 
          foreach($breadcrumb as $link=>$item) {  ?>
          <?php if($item == end($breadcrumb)){ ?>
          <span class="breadcrumb-item active"><?=$dictionary->get($item);?></span>
          <?php continue;} ?>
          <a class="breadcrumb-item" href="<?=$link?>"><?=$dictionary->get($item);?></a>
          
        <?php } ?>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-50 pd-t-20 pd-sm-t-15">
        <h4 class="tx-gray-800 mg-b-5"><?=$title;?></h4>
      </div>

      <div class="content">
        <div class="br-pagebody">
            <?=$contents?>
        </div>
      </div>

      <footer class="br-footer">
      </footer> 

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <div id="modaldemo" class="modal fade effect-scale">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0 rounded-0">
          <div class="modal-body pd-0">
            <div class="row flex-row-reverse no-gutters">
              <div class="col-lg-6">
                <div class="pd-30">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <div class="pd-xs-x-30 pd-y-10">
                    <h5 class="tx-xs-28 tx-inverse mg-b-5">Welcome back!</h5>
                    <p>Sign in to your account to continue</p>
                    <br>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control pd-y-12" placeholder="Enter your email">
                    </div><!-- form-group -->
                    <div class="form-group mg-b-20">
                      <input type="email" name="password" class="form-control pd-y-12" placeholder="Enter your password">
                      <a href="" class="tx-12 d-block mg-t-10">Forgot password?</a>
                    </div><!-- form-group -->

                    <button class="btn btn-primary pd-y-12 btn-block">Sign In</button>

                    <div class="mg-t-30 mg-b-20 tx-12">Don't have an account yet? <a href="">Sign Up</a></div>
                  </div>
                </div><!-- pd-20 -->
              </div><!-- col-6 -->
              <div class="col-lg-6 bg-primary">
                <div class="pd-40">
                  <h4 class="tx-white mg-b-20"><span>[</span> bracket + <span>]</span></h4>
                  <p class="tx-white op-7 mg-b-60">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                  <p class="tx-white tx-13">
                    <span class="tx-uppercase tx-medium d-block mg-b-15">Our Address:</span>
                    <span class="op-7">Ayala Center, Cebu Business Park, Cebu City, Cebu, Philippines 6000</span>
                  </p>
                </div>
              </div><!-- col-6 -->
            </div><!-- row -->
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <?php foreach($js as $link) { ?>
      <script src="<?= $link?>"></script>
    <?php } ?>

    <script>
      $(document).ready(function() {
            $('body').popover({ 
                selector: '[data-toggle=popover]' ,
                html : true,
                content: function() {
                  var content = $(this).attr('data-popover-content');
                  return $(content).children('.popover-body').html();
                },
                title: function() {
                  var title = $(this).attr('data-popover-content');
                  return $(title).children('.popover-heading').html();
                }
            });
        });
      $(function(){
        'use strict'

        $('.form-layout .form-control').on('focusin', function(){
          $(this).closest('.form-group').addClass('form-group-active');
        });

        $('.form-layout .form-control').on('focusout', function(){
          $(this).closest('.form-group').removeClass('form-group-active');
        });

        // Select2
        $('#select2-a, #select2-b').select2({
          minimumResultsForSearch: Infinity
        });

        $('#select2-a').on('select2:opening', function (e) {
          $(this).closest('.form-group').addClass('form-group-active');
        });

        $('#select2-a').on('select2:closing', function (e) {
          $(this).closest('.form-group').removeClass('form-group-active');
        });

      });

      <?=$scripts?>
    </script>
  

<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>