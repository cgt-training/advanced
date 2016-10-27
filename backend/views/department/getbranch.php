<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

  <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'b_id')->widget(Select2::classname(), [
        'data' => $List_Branches_Arr,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a Branch ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
      ]);
    ?>