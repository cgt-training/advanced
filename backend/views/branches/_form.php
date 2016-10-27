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

    <?php $form = ActiveForm::begin([
                                      'id' => 'branches_form_id',
                                      'action' => '#',
                                  ]); ?>

    <?= $form->field($model, 'b_id')->textInput() ?>

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

    <?= $form->field($model, 'c_id')->dropDownList([ $List_Company_Arr, ], ['prompt' => '']) ?>

    <?= $form->field($model, 'br_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'br_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'br_created')->textInput() ?>

    <?= $form->field($model, 'br_status')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit_id']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
</script>