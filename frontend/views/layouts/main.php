<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Pjax;

AppAsset::register($this);

$img_path = Yii::$app->request->baseUrl . '/frontend/web/images/';

//$time = date('Y-m-d');
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

<body>
<?php $this->beginBody() ?>
<body style="background-color:#000;">
<div class="container-fluid  img-responsive">
    <div class="container main_panel img-responsive">
      <div class="row">
        <div class="col-lg-2 col-md-2">
          <img src=<?=$img_path."/logo.jpeg";?> class="img-responsive" height="100">
        </div>
        <div class="col-lg-5 col-md-5">
          <div class="row" style="margin-top:30px;">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#site-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="">
                <!--div class="logo">
                </div-->
              </a>
            </div>
            <div class="navbar-collapse collapse col-padding" id="site-menu">
              <ul class="nav nav-tabs text-capitalize nav-justified menu">
                <!--<li class="active"><?= Html::a("Home", ['#'],['id'=>'home_id']) ?></li>-->
                <li class="active"><?= Html::a("Company", ['#'],['id'=>'company_id']) ?></li>
                <li><?= Html::a("Branches", ['#'],['id'=>'branch_id']) ?></li>
                <li><?= Html::a("Department", ['#'],['id'=>'dept_id']) ?></li>
                <li><?= Html::a("Location", ['#'],['id'=>'loc_id']) ?></li>
                <li><?= Html::a("Customer", ['#'],['id'=>'cust_id']) ?></li>
                <!--<a href="/advanced/site/index"><strong>Home</strong></a>
                <li ><a href="/advanced/site/about"><strong>About</strong></a></li>
                <li ><a href="/advanced/company"><strong>Company</strong></a></li>
                <li ><a href="/advanced/branches"><strong>Branches</strong></a></li>
                <li ><a href="/advanced/department"><strong>Department</strong></a></li>-->
              </ul>
            </div>
         </div>
        </div>
        <div class="col-lg-4 col-md-2" style="margin-top:40px;float:right;color:#fff;display:inline">
          <span style="margin-left:80px;">
          <?php
          if (Yii::$app->user->isGuest) {
            echo Html::a("Register", ['/'],['id'=>'register_id','style'=>'color:#fff;']);
            echo "&nbsp;|&nbsp;";
            echo Html::a("Log In", ['/'],['id'=>'login_id','style'=>'color:#fff;']);
          }
          else
          {
            echo Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['/'],['id'=>'logout_id','style'=>'color:#fff;']);

            /*echo Html::beginForm(['/site/logout'], 'post');
            echo Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            );
            echo Html::endForm();
            */
          }
          ?>
          </span>
          <div style="float:right;position:relative;">
            <button type="submit" class="btn btn-warning" id="about_id">About-Us</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center" style="color:#fff;">
          <h1 style="font-size:65px;">Necesitas Classes</h1>
          <p><h3>Busca .Contrata. Apredna</h3></p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">&nbsp;</div>
      </div>
      <div class="row">
        <div class="col-lg-3 text-center"></div>
        <div class="col-lg-8 col-md-8">
          <ul class="nav nav-tabs nav_1">
            <li class="active round-tabs"><a data-toggle="tab" href="#student_div">
              <img src="<?=$img_path."/book.jpeg";?>" class="img-responsive cirlce_class stu_form" height="50">
              <p class="text-center" style="color:#fff;"><strong>Tutor</strong></p>
              </a>
              </li>
            <li class="round-tabs"><a data-toggle="tab" href="#tutor_div">
              <img src="<?=$img_path."/book.jpeg";?>" class="img-responsive cirlce_class" height="50">
              <p class="text-center" style="color:#fff;"><strong>Student</strong></p>
            </a></li>
            <li class="round-tabs"><a data-toggle="tab" href="#exchange_div">
              <img src="<?=$img_path."/book.jpeg";?>" class="img-responsive cirlce_class" height="50">
              <p class="text-center" style="color:#fff;"><strong>Exchange</strong></p>
            </a></li>
          </ul>
          <div class="tab-content">
            <div id="student_div" class="tab-pane fade in active">
            <div class="row" style="margin-top:45px;">
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" size="25" placeholder="Enter KeyWord">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group text-left" style="float:left;">
                  <input type="text" name="search" class="form-control" placeholder="State">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Location">
                </div>
              </div>
              <div class="col-lg-1 text-center">
                <div class="input-group">
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </div>
              <div class="col-lg-1 text-center"></div>
            </div>
            </div>
            <div id="tutor_div" class="tab-pane fade in">
            <div class="row" style="margin-top:45px;">
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" size="25" placeholder="Enter Name">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group text-left" style="float:left;">
                  <input type="text" name="search" class="form-control" placeholder="Class">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Subject">
                </div>
              </div>
              <div class="col-lg-1 text-center">
                <div class="input-group">
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </div>
              <div class="col-lg-1 text-center"></div>
            </div>
            </div>
            <div id="exchange_div" class="tab-pane fade in">
            <div class="row" style="margin-top:45px;">
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" size="25" placeholder="Enter KeyWord">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group text-left" style="float:left;">
                  <input type="text" name="search" class="form-control" placeholder="Course Name">
                </div>
              </div>
              <div class="col-lg-3 text-center">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Changed Course">
                </div>
              </div>
              <div class="col-lg-1 text-center">
                <div class="input-group">
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </div>
              <div class="col-lg-1 text-center"></div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">&nbsp;</div>
      </div>
      <div class="row" id="student_div" style="display:none;">
        <div class="col-lg-3 text-center"></div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" size="25" placeholder="Enter KeyWord">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group text-left" style="float:left;">
            <input type="text" name="search" class="form-control" placeholder="State">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Location">
          </div>
        </div>
        <div class="col-lg-1 text-center">
          <div class="input-group">
            <button type="submit" class="btn btn-warning">Submit</button>
          </div>
        </div>
        <div class="col-lg-1 text-center"></div>
      </div>
      <div class="row" id="tutor_div" style="display:none;">
        <div class="col-lg-3 text-center"></div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" size="25" placeholder="Enter Name">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group text-left" style="float:left;">
            <input type="text" name="search" class="form-control" placeholder="Class">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Subject">
          </div>
        </div>
        <div class="col-lg-1 text-center">
          <div class="input-group">
            <button type="submit" class="btn btn-warning">Submit</button>
          </div>
        </div>
        <div class="col-lg-1 text-center"></div>
      </div>
      <div class="row" id="exchange_div" style="display:none;">
        <div class="col-lg-3 text-center"></div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" size="25" placeholder="Enter KeyWord">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group text-left" style="float:left;">
            <input type="text" name="search" class="form-control" placeholder="Course Name">
          </div>
        </div>
        <div class="col-lg-2 text-center">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Changed Course">
          </div>
        </div>
        <div class="col-lg-1 text-center">
          <div class="input-group">
            <button type="submit" class="btn btn-warning">Submit</button>
          </div>
        </div>
        <div class="col-lg-1 text-center"></div>
      </div>
    </div>
    <div id="pjax_main_container" class="container" style="background-color:#FFF;">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
    </div>
  </div>
<!--
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'About', 'url' => ['/site/about']],
        //['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'Compnay', 'url' => ['/company']],
        ['label' => 'Branches', 'url' => ['/branches']],
        ['label' => 'Departments', 'url' => ['/department']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
-->

    <div class="container" style="background-color:#fff;">
      <div class="row"><div class="col-lg-12 text-center">&nbsp;</div></div>
        <div class="row">
          <div class="col-lg-2 col-md-2 text-center">&nbsp;</div>
          <div class="col-lg-3 col-md-3 text-center"> 
            <div class="block">
              <span><img src=<?=$img_path."/last-row-icon.jpeg"?> style="margin-left:15px;"></span>
              <div style="color:purple;"><stromg>Inform Student</stromg></div>
              <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 text-center"> 
            <div class="block">
              <span><img src=<?=$img_path."/last-row-icon.jpeg"?> class="img-responsive" style="margin-left:95px;"></span>
              <div style="color:purple;"><stromg>Its Free</stromg></div>
              <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
              Lorem ipsum dolor sit amet, consectetur adipisicing elit
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 text-center"> 
            <div class="block">
              <span><img src=<?=$img_path."/last-row-icon.jpeg"?> class="img-responsive" style="margin-left:95px;"></span>
              <div style="color:purple;"><stromg>Save Time</stromg></div>
              <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
              Lorem ipsum dolor sit amet, consectetur adipisicing elit
              </div>
            </div>
          </div>
          <div class="col-lg-1 col-md-1 text-center">&nbsp;</div>
        </div>
        <div class="row"><div class="col-lg-12 text-center">&nbsp;</div></div>
        <div class="row">
          <div class="col-lg-1 text-center">&nbsp;</div>
          <div class="col-lg-4 text-center">
            <span><img src=<?=$img_path."/bottom-icon.jpeg"?> class="img-responsive"></span>
          </div>
        </div>
      </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">

  $("#home_id").click({url_link: "site/index"}, load_data);
  $("#dept_id").click({url_link: "department"}, load_data);
  $("#branch_id").click({url_link: "branches"}, load_data);
  $("#company_id").click({url_link: "company"}, load_data);
  $("#loc_id").click({url_link: "location"}, load_data);
  $("#cust_id").click({url_link: "customer"}, load_data);
  $("#about_id").click({url_link: "site/about"}, load_data);
  $("#register_id").click({url_link: "site/signup"}, load_data);
  $("#login_id").click({url_link: "site/login"}, load_data);
  $("#logout_id").click({url_link: "site/logout"}, load_data);

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