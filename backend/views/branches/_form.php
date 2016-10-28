<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
//use kartik\select2-master\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">
  <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['id' => 'branches_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>

    <div class="box-body">

    <?= $form->field($model, 'b_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Branch Id']) ?>

    <?php
       /* echo $form->field($model, 'c_id')->widget(Select2::classname(), [
        'data' => $List_Company_Arr,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
      ]);*/
    ?>

    <?= $form->field($model, 'c_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->dropDownList([ $List_Company_Arr, ], ['prompt' => '','placeholder'=>'Select Company'])?>

    <?= $form->field($model, 'br_name', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Name']) ?>

    <?= $form->field($model, 'br_address', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textarea(['rows' => 4,'placeholder'=>'Address']) ?>

    <?= $form->field($model, 'br_created', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->textInput(['maxlength' => true,'placeholder'=>'Created Date'])?>

    <?= $form->field($model, 'br_status', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                            ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '','placeholder'=>'Status'])?>

    <div class="form-group col-sm-12 text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a('Cancel', ['/branches/'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

<?php
    $form = ActiveForm::begin();
    $form->field($model, 'br_created')->widget(DatePicker::className(),[
   'name' => 'br_created',
   'language' => 'en-GB',
   'dateFormat' => 'yyyy-MM-dd',
   'options' => [
      'changeMonth' => true,
      'changeYear' => true,
      'yearRange' => '1996:2099',
      'showOn' => 'button',
      'buttonImage' => 'images/calendar.gif',
      'buttonImageOnly' => true,
      'buttonText' => 'Select date'
    ],
]) 
?>

<script type="text/javascript">
/*
var url_data = "branches/create";

if($('#branches-b_id').val())
  var url_data = "branches/update?id="+$('#branches-b_id').val();

  $('#submit_id').click(function(){
    $.ajax({
        url: url_data,
        type:"post",
        data: $('#branches_form_id').serialize(),

       success: function(result){
        $('#modal').modal('hide');
        document.getElementById('pjax_main_container').innerHTML = result;
        //$.pjax.reload({ container: '#branchPjax'});
       // $("#pjax_main_container").html(result);
        return false;
    }});
    return false;
  });
  */
</script>