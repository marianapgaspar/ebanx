<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->

    <link rel="icon" type="image/png" sizes="32x32" href="https://calendario.mercosur.int/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.cardume.digital/public/sites/mercosulmotores/favicons/favicon-16x16.png">

    <title>Error</title>

    <?php foreach($css as $link) { ?>
      <link rel="stylesheet" media="all" href="<?= $link?>">
    <?php } ?>
</head>
<body> 
    <div class="error">
        <div class="error__container">
            <div class="error__wrap">
                <?php foreach($error as $erro) {  ?>
                    <?php if($erro['active']==true){ ?>
                        <div class="error__head">
                            <img class="error__pic" src="<?=url()->toRoute('public/common/img/'.$erro['image'].'')?>">
                        </div> 
                        <div class="error__bottom">
                            <?= $erro['message']?>  
                        </div> 
                    <?php continue;} ?>
                <?php } ?>                    
            </div>
        </div>
    </div>
</body>
</html>