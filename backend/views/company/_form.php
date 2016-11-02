<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>
        <div class="box-body">

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Company</h4></div>
                    <div class="panel-body">
                        <div class="class="container-items"">

                            <?= $form->field($modelCompany, 'c_name', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                        'labelOptions' => [ 'class' => 'control-label col-sm-3' ]
                                                    ])->textInput(['maxlength' => true,'placeholder'=>'Company Name'])?>

                            
                            <?= $form->field($modelCompany, 'c_email', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                        'labelOptions' => [ 'class' => 'control-label col-sm-3' ]
                                                    ])->textInput(['maxlength' => true, 'placeholder'=>'Company Email'])?>
                            
                            <?= $form->field($modelCompany, 'c_add', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                        'labelOptions' => [ 'class' => 'control-label col-sm-3', 'placeholder'=>'Address']
                                                    ])->textarea(['rows' => 4])?>

                             <?= $form->field($modelCompany, 'c_logo', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                        'labelOptions' => [ 'class' => 'control-label col-sm-3', 'placeholder'=>'Logo']
                                                        ])->fileInput()?>

                            <?= $form->field($modelCompany, 'c_status', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                                'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                            ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Select Status','class'=>'form-control select2','style'=>"width: 100%;"])?>

                        </div>
                     </div>
                </div>
            </div>
            <div class="col-sm-6">
                 <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Branches</h4></div>
                <div class="panel-body">
                     <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 4, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelBranches[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'br_name',
                            'br_address',
                            'br_created',
                            'br_status',
                        ],
                    ]); ?>

                    <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelBranches as $i => $modelBranches): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Branches</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (! $modelBranches->isNewRecord) {
                                        echo Html::activeHiddenInput($modelBranches, "[{$i}]b_id");
                                    }
                                ?>

                                <?= $form->field($modelBranches, "[{$i}]br_name", ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Branch Name']) ?>

                                <?= $form->field($modelBranches, "[{$i}]br_address", ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textarea(['rows' => 4,'placeholder'=>'Address']) ?>

                                <?= $form->field($modelBranches, "[{$i}]br_status", ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                            ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Select Stauts','class'=>'form-control select2','style'=>"width: 100%;"])?>


                                </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
            </div>
        </div>

        <div class="form-group col-sm-12 text-center">
            <?= Html::submitButton($modelBranches->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['/user/'], ['class'=>'btn btn-danger']) ?>
        </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->registerJs("$('.select2').select2();");?>
