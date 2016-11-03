<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'company_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>
    <div class="box-body">

        <?php echo  $form->field($model, 'c_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3','placeholder'=>'Id' ]
                                        ])->textInput()?>

        <?php echo  $form->field($model, 'c_name', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3' ]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Name'])?>

        <?php echo  $form->field($model, 'c_email', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3' ]
                                        ])->textInput(['maxlength' => true, 'placeholder'=>'Email'])?>

        <?php echo  $form->field($model, 'c_add', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3', 'placeholder'=>'Address']
                                        ])->textarea(['rows' => 6])?>

        <?php echo  $form->field($model, 'c_logo', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3', 'placeholder'=>'Logo']
                                            ])->fileInput()?>

        <?php echo  $form->field($model, 'c_start_date', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3','placeholder'=>'Start Date']
                                                ])->textInput()?>

        <?php echo  $form->field($model, 'c_create_date', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3', 'placeholder'=>'Create Date']
                                                ])->textInput()?>

        <?php echo  $form->field($model, 'c_status', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])?>

        <div class="form-group col-sm-12 text-center">
            <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php echo  Html::a('Cancel', ['/company/'], ['class'=>'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
/*
var url_data = "company/create";
/*
 $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    });

if($('#company-c_id').val())
  var url_data = "company/update?id="+$('#company-c_id').val();

  $('#submit_id').click(function(){
    $.ajax({
        url: url_data, 
        type:"post",

        //data: $('#company_form_id').serialize(),
        data: $('#company_form_id').serialize(),

       success: function(result){
        $('#modal').modal('hide');
        //$.pjax.reload({ container: '#pjax_main_container'});
        document.getElementById('pjax_main_container').innerHTML = result;
        //alert(result);
        
        //$("#pjax_main_container").html(result);
        //return false;
    }});
    return false;
  });
  */
</script>
