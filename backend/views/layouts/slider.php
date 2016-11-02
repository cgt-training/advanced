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
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src=<?=$img_path."/dist/img/user2-160x160.jpg"?> class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo strtoupper(Yii::$app->user->identity->username);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Main Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><?= Html::a("<i class='fa fa-circle-o'></i>Dashboard", ['/site'],['id'=>'company_id']) ?></li>
            <!--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>-->
            <li><?= Html::a("<i class='fa fa-users'></i>User", ['/user'],['id'=>'user_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-home'></i>Company", ['/company'],['id'=>'company_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-laptop'></i>Branches", ['/branches'],['id'=>'branch_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-table'></i>Department", ['/department'],['id'=>'dept_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-location-arrow'></i>Location", ['/location'],['id'=>'loc_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-user'></i>Customer", ['/customer'],['id'=>'cust_id']) ?></li>
            <li><?= Html::a("<i class='fa fa-book'></i>Roles & Permissions", ['/auth-item'],['id'=>'role_id']) ?></li>
            <li>
            <?php
            if (!Yii::$app->user->isGuest)
              echo Html::a('<i class="fa fa-power-off" text-red"></i>Logout (' . Yii::$app->user->identity->username . ')', ['/site/logout']);
            ?>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>