<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LocationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'loc_id') ?>

    <?php echo  $form->field($model, 'zip_code') ?>

    <?php echo  $form->field($model, 'city') ?>

    <?php echo  $form->field($model, 'province') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
