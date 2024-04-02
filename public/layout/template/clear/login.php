<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://calendario.mercosur.int/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.cardume.digital/public/sites/mercosulmotores/favicons/favicon-16x16.png">
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
<?php foreach($js as $link) { ?>
      <script src="<?= $link?>"></script>
    <?php } ?>
  </head>
  <body>
    <div class="out">
      <div class="login"style="background-image:url('<?=url()->toRoute('public/common/img/background_login.png')?>');
      background-position: center;
  background-repeat: no-repeat; 
  background-size: cover;">
        <div class="login__container" >
          <div class="login__wrap">
            
            <form class="login__form" method="POST">
            <div>
              <?php foreach($localisations as $localisation){ ?>
                  
                <?php } ?>
            </div>
              <div class="login__body">
              <div class="login__head"><a class="login__logo" href="#"><img class="login__pic" src="<?=url()->toRoute('public/common/img/logo.png')?>" alt=""></a></div>
                <div class="login__title login__title_sm"><?=$dictionary->get($title)?></div>
                <div class="login__field field">
                  <div class="field__wrap"><input class="field__input" id='user' name="user" placeholder="<?=$dictionary->get('user')?>"></div>
                </div>
                <div class="login__field field">
                  <div class="field__wrap"><input class="field__input" id='password' type="password" name="password" placeholder="<?=$dictionary->get('password')?>"></div>
                </div>
                <button class="login__btn btn btn-success" style=" color:aliceblue" type="submit" id="login"><?=$dictionary->get('login')?></button>
                <p style="text-align: center; margin-top:10px; color:red" id="message"></p>
                <ul class="login__links">                
                  <li>
                    <a class="login__link" href="<?= url()->toRoute('users/forgot')?>"><?=$dictionary->get('forgot')?></a> | 
                    <a class="login__link" href="#" id="reminder"><?=$dictionary->get('reminder')?></a>
                    <a class="login__link" href="#" onclick="javascript:$('#redefinir_senhaModal').show()" id="redefinir"> | Redefinição de senha</a>
                  </li>
                </ul>
              </div>
            </form>
            <div class="login__bottom">
              
            </div>
          </div>
        </div>
        <!--<label class="switch switch_theme"><input class="switch__input js-switch-theme" type="checkbox" /><span class="switch__in"><span class="switch__box"></span><span class="switch__icon"><svg class="icon icon-moon">
                <use xlink:href="img/sprite.svg#icon-moon"></use>
              </svg><svg class="icon icon-sun">
                <use xlink:href="img/sprite.svg#icon-sun"></use>
              </svg></span></span></label> -->
      </div>
    </div>
    <div class="modal modal-table" tabindex="-1" role="dialog" aria-hidden="true" id="redefinir_senhaModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Redefinição de senha</h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="user_redefine" class="col-form-label">Usuário:</label>
              <input type="text" class="form-control" name="user_redefine" id="user_redefine">
            </div>
            <div class="form-group">
              <label for="atual_password" class="col-form-label">Senha atual:</label>
              <input type="password" class="form-control" name="atual_password" id="atual_password">
            </div>
            <div class="form-group">
              <label for="nova_password" class="col-form-label">Senha Nova:</label>
              <input type="password" class="form-control" name="nova_password" id="nova_password">
            </div>
            <div class="form-group">
              <label for="repetir_password" class="col-form-label">Repetir Senha:</label>
              <input type="password" class="form-control" name="repetir_password" id="repetir_password">
            </div>
            <div class="form-group">
              <p style="text-align: center; margin-top:10px; color:red" id="message_redefinir"></p>
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="redefinir_senha()">Refefinir</button>
            <button type="button" class="btn btn-secondary" onclick="javascript:$('#redefinir_senhaModal').hide()" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
   <script>
  var objCssSuccess  = {"color":" blue","background":"#ddd","padding":"10px","font-weight":"bold"};
  var objCssError  = {"color":" red","background":"#ddd","padding":"10px","font-weight":"bold"};
  $('#reminder').on('click',function(){
      $.ajax({
        url:'<?= $urlLogin ?>/reminder',
        dataType:'json',
        method:'POST',
        data:{user:$('#user').val()},
        success:function(data){  
          console.log(data)
          $('#message').html(data.message).css(objCssSuccess);
        },
        error:function(data){  
          $('#message').html(data.responseJSON.message).css(objCssError);
        }
      })
  });

  $('#login').on('click',function(e){
    e.preventDefault();
    $('#message').html('')
    $.post( "<?= $urlLogin ?>",{user:$('#user').val(),password:$('#password').val()}, function(data) {
      if(data.success){
        window.location.href = "<?=$urlRedirect?>";
      }else{
        $('#message').html(data.message).css(objCssError);
      }
    });
  });
  redefinir_senha = function(){
    $.ajax({
        url:'<?= $urlLogin ?>/redefinir',
        dataType:'json',
        method:'POST',
        data:{
          user:$('#user_redefine').val(),
          atual_password:$('#atual_password').val(),
          nova_password:$('#nova_password').val(),
          repetir_password:$('#repetir_password').val(),
        },
        success:function(data){  
          console.log(data)
          $('#message_redefinir').html(data.message).css(objCssSuccess);
        },
        error:function(data){  
          $('#message_redefinir').html(data.responseJSON.message).css(objCssError);
        }
      })
  }
  $('.localisation').on('click',function(){
    $.get("<?=url()->toRoute('localisation/change')?>/"+$(this).attr('code'),function(){
      location.reload();
    });
  });
</script>
  </body>
</html>