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

    <?= $form->field($model, 'b_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->dropDownList($List_Branches_Arr, ['prompt' => 'Select Branch','class'=>'form-control select2','style'=>"width: 100%;"]) ?>