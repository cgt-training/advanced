<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'c_id') ?>

    <?php echo  $form->field($model, 'c_name') ?>

    <?php echo  $form->field($model, 'c_email') ?>

    <?php echo  $form->field($model, 'c_add') ?>

    <?php echo  $form->field($model, 'c_start_date') ?>

    <?php // echo $form->field($model, 'c_create_date') ?>

    <?php // echo $form->field($model, 'c_status') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
