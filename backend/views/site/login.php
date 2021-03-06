<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<body class="hold-transition login-page">
<h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Admin</b>LTE</a>
      </div>
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>

              <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="form-group has-feedback">
                  <?php echo  $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Email'])->label(false) ?>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <?php echo  $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <div class="checkbox icheck">
                      <label>
                        <?php echo  $form->field($model, 'rememberMe')->checkbox() ?>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-4">
                      <div class="form-group">
                          <?php echo  Html::submitButton('Sign In', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                      </div>
                  </div>
                </div>
              <?php ActiveForm::end(); ?>
              <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
            </div>
          </div>
    </div>
</body>
