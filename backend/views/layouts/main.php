<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use yii\widgets\Pjax;

DashboardAsset::register($this);

$img_path = Yii::$app->request->baseUrl . '/backend/web';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="skin-blue sidebar-mini wysihtml5-supported">
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
   /* NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];*/
    if (Yii::$app->user->isGuest) {
        ?>
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
        <?php
    } else {

        ?>
            <div class="wrapper">
            <!--Header Part -->
                <?php $this->beginContent('@app/views/layouts/header.php'); ?>
                <?php $this->endContent(); ?>

              <!-- Left side column. contains the logo and sidebar -->
                <?php $this->beginContent('@app/views/layouts/slider.php'); ?>
                <?php $this->endContent(); ?>  

              <!-- Content Wrapper. Contains page content -->
              <div class="content-wrapper" id="pjax_main_container">
                <!-- Content Header (Page header) -->
                 <?=$content;?>
                <!-- /.content -->
              </div>
              <!-- /.content-wrapper -->
              

              <?php $this->beginContent('@app/views/layouts/footer.php'); ?>
                <?php $this->endContent(); ?>

                <?php $this->beginContent('@app/views/layouts/control-slider.php'); ?>
                <?php $this->endContent(); ?>
              <!-- /.control-sidebar -->
              <!-- Add the sidebar's background. This div must be placed
                   immediately after the control sidebar -->
              <div class="control-sidebar-bg"></div>
            </div>
        <?php
    }
    ?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">

    //  $.widget.bridge('uibutton', $.ui.button);
    $("#home_id").click({url_link: "./site/index"}, load_data);
    $("#dept_id").click({url_link: "./department"}, load_data);
    $("#branch_id").click({url_link: "branches"}, load_data);
    $("#company_id").click({url_link: "company"}, load_data);
    $("#loc_id").click({url_link: "location"}, load_data);
    $("#cust_id").click({url_link: "customer"}, load_data);
    $("#register_id").click({url_link: "site/signup"}, load_data);
    $("#login_id").click({url_link: "site/login"}, load_data);


  // in your function, just grab the event object and go crazy...
  function load_data(event){
      //var url = event.data.url;
      $.ajax({
            url: event.data.url_link, 
            type:"post",

           success: function(result){
            //$.pjax.reload({ container: '#pjax_main_container'});
            $("#pjax_main_container").html(result);
            return false;
        }});
      return false;
  }

  $(".menu a").on("click", function(){
     $(".menu").find(".active").removeClass("active");
     $(this).parent().addClass("active");
  });

</script>