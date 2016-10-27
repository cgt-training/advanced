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

    <?php $form = ActiveForm::begin(['id' => 'company_form_id','action' => '#','options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'c_id')->textInput() ?>

    <?= $form->field($model, 'c_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_add')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c_logo')->fileInput() ?>

    <?= $form->field($model, 'c_start_date')->textInput() ?>

    <?= $form->field($model, 'c_create_date')->textInput() ?>

    <?= $form->field($model, 'c_status')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit_id']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

var url_data = "company/create";

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
</script>
