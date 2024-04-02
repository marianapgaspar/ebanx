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
        <div class="login__container" <?= $page=='forgot'? '':'style="background:#888"' ?>>
          <div class="login__wrap">
            <div class="login__head"></div>
            <form class="login__form" id="formForgot">
            <div>
              <?php foreach($localisations as $localisation){ ?>
                  
                <?php } ?>
            </div>
              <div class="login__body">
              <a class="login__logo" href="#">
            <img class="login__pic" src="<?=url()->toRoute('public/common/img/logo.png')?>" alt=""></a>
                <div class="login__title login__title_sm"><?=$dictionary->get($title)?></div>
                
                <?php  if($page=='forgot'):  ?>
                  <div class="login__field field">
                    <div class="field__wrap"><input class="field__input" id='user' name="user" placeholder="Usuário ou email" required></div>
                  </div>
                  <button class="login__btn btn btn" type="submit" style="background-color: #164111; color:aliceblue" type="button" id="login"><?=$dictionary->get('send')?></button>
                <?php  else: ?>
                  <div class="login__field field">
                    <div class="field__wrap"><input class="field__input"  type="password" id="password" name="password" placeholder="<?=$dictionary->get('password')?>" required></div>
                  </div>
                  <div class="login__field field">
                    <div class="field__wrap"><input class="field__input"  type="password" id="confirm_password"  name="new_password" placeholder="<?=$dictionary->get('repeat_password')?>" required></div>
                  </div>
                  <button class="login__btn btn btn" type="submit" style="background-color: #888; color:aliceblue" type="button" id="login"><?=$dictionary->get('save')?></button>

                <?php  endif; ?>
                <p style="text-align: center; margin-top:10px; color:red" id="message"></p>
                <ul class="login__links ">                
                  <li><a class="login__link" href="<?= url()->toRoute('users/login')?>"><?=$dictionary->get('back')?></a></li>
                </ul>
              </div>
            </form>
            <div class="login__bottom">
              <ul class="login__links">
                <li><a class="login__link" href="#"><?=$dictionary->get('terms')?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
   <script>
   <?php $page=='forgot'? 'POST':'PUT' ?>

   $('#formForgot').on('submit',function(e){
    e.preventDefault();
     $('#message').html('');
        var dados = $('form').serialize();

      <?php if($page != 'forgot'): ?>
        var password = $("#password") 
        var confirm_password = $("#confirm_password")
        if(password.val()!= confirm_password.val()) {
          $('#message').html('Senhas diferentes');
          return false;
        }       

      <?php endif ?>
  
     $.ajax({
       url:"<?= $urlLogin ?>",
       method:"POST",
       dataType:'Json',
       data:dados,
       success: function(data){
          if(data.success){
            if(data.message == 'Senha alterada com sucesso'){
              window.location.href = "<?=url()->toRoute('users/login')?>";
            }else{
              $('#message').html("Verifique seu e-mail para redefinição de senha");
            }
          }else{             
            $('#message').html(data.message);
          }    
        },error: function(data){ 
          console.log(data)
            $('#message').html(data.responseJSON.message);
        }
     });     

});





$('.localisation').on('click',function(){
      $.get("<?=url()->toRoute('localisation/change')?>/"+$(this).attr('code'),function(){
        location.reload();
      });
    });
</script>
  </body>
</html>