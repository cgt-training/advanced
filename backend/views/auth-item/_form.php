<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */

$Style_Var = $model->isNewRecord ? 'width:100%; margin:0 auto;' : 'width:50%; margin:0 auto;';
?>

<div class="auth-item-form" style="<?php echo $Style_Var;?>">
    <h1><?php echo  Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'authitem_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>
        <div class="box-body">
            <?php echo  $form->field($model, 'name', ['template' => "{label}\n<div class='col-sm-6'>{input}</div>\n{hint}\n{error}",
                                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                        ])->textInput(['maxlength' => true,'placeholder'=>'Permission Name']) ?>

            <?php echo  $form->field($model, 'description', ['template' => "{label}\n<div class='col-sm-6'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->textarea(['rows' => 4,'placeholder'=>'Description']) ?>

            <div class="form-group col-sm-12 text-center">
                <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                <?php echo  Html::a('Cancel', ['/auth-item/'], ['class'=>'btn btn-danger']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

</div>
