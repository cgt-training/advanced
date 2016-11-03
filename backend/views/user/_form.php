<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'user_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>
    <div class="box-body">

        <?php echo  $form->field($model, 'username', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3','placeholder'=>'Id' ]
                                        ])->textInput(['maxlength' => true])?>

        <?php echo  $form->field($model, 'email', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3','placeholder'=>'Id' ]
                                        ])->textInput(['maxlength' => true])?>

        <?php echo  $form->field($model, 'role', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->dropDownList([ 'admin' => 'Admin', 'teacher' => 'Teacher', 'student'=>'Student'], ['prompt' => 'Select Role'])?>


        <div class="form-group col-sm-12 text-center">
            <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php echo  Html::a('Cancel', ['/user/'], ['class'=>'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
