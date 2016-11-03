<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */
/* @var $form yii\widgets\ActiveForm */
$Style_Var = $model->isNewRecord ? 'width:100%; margin:0 auto;' : 'width:50%; margin:0 auto;';
$Title_Val = $model->isNewRecord ? '' : "<h1>".Html::encode($this->title)."</h1>";
?>

<div class="department-form" style="<?php echo $Style_Var;?>">

    <?php $form = ActiveForm::begin(['id' => 'dept_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>

    <?php echo $Title_Val;?>

    <div class="box-body">

      <?php echo  $form->field($model, 'c_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->dropDownList($List_Company_Arr, ['prompt' => 'Select Company','class'=>'form-control select2','style'=>"width: 100%;"]) ?>

      <?php echo  $form->field($model, 'b_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->dropDownList($List_Branches_Arr, ['prompt' => 'Select Branch','class'=>'form-control select2','style'=>"width: 100%;"]) ?>

      <?php echo  $form->field($model, 'dept_name', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Department Name']) ?>

      <?php echo  $form->field($model, 'dtep_status', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Select Status','class'=>'form-control select2','style'=>"width: 100%;"]) ?>

       <?php
       /*
            echo $form->field($model, 'dtep_status')->widget(Select2::classname(), [
            'data' => [ 'Yes' => 'Yes', 'No' => 'No', ],
            'language' => 'de',
            'options' => ['placeholder' => 'Select a Status ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
          ]);
      */
      ?>

      <div class="form-group col-sm-12 text-center">
          <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit_id']) ?>
          <?php echo  Html::a('Cancel', ['/department/'], ['class'=>'btn btn-danger']) ?>
      </div>
    </div>

  <?php ActiveForm::end(); ?>

</div>

<?php echo  $this->registerJs("$('.select2').select2();");?>

<script type="text/javascript">

var url_data = "department/create";

if($('#department-dept_id').val())
  var url_data = "department/update?id="+$('#department-dept_id').val();

  $('#department-c_id').change(function(){
    var company_id = $('#department-c_id').val();
    $.ajax({
        url: "department/getbranch?c_id="+company_id, 
        type:"post",

       success: function(result){
        document.getElementById('department-b_id').innerHTML=result;
        return false;
    }});
    return false;
  });

/*
  $('#submit_id').click(function(){
    $.ajax({
        url: url_data, 
        type:"post",
        data: $('#dept_form_id').serialize(),

       success: function(result){
        $('#modal').modal('hide');
        document.getElementById('pjax_main_container').innerHTML = result;
        //$.pjax.reload({ container: '#departmentPjax'});
        //$("#pjax_main_container").html(result);
        return false;
    }});
    return false;
  });
  */

</script>