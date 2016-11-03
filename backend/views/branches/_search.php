<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BranchesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'b_id') ?>

    <?php echo  $form->field($model, 'c_id') ?>

    <?php echo  $form->field($model, 'br_name') ?>

    <?php echo  $form->field($model, 'br_address') ?>

    <?php echo  $form->field($model, 'br_created') ?>

    <?php // echo $form->field($model, 'br_status') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
