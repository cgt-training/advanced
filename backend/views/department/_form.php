<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin([
                                      'id' => 'dept_form_id',
                                      'action' => '#',
                                  ]); ?>

    <?= $form->field($model, 'dept_id')->textInput() ?>

    <?php
        /*echo $form->field($model, 'c_id')->widget(Select2::classname(), [
        'data' => $List_Company_Arr,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
      ]);
*/
    ?>

    <?php
  /*      echo $form->field($model, 'b_id')->widget(Select2::classname(), [
        'data' => $List_Branches_Arr,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a Branch ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
      ]);
*/
    ?>

    <?= $form->field($model, 'c_id')->dropDownList([ $List_Company_Arr, ], ['prompt' => '']) ?>
    <?= $form->field($model, 'b_id')->dropDownList([ $List_Branches_Arr, ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dept_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'dept_created_date')->textInput() ?>

    <?= $form->field($model, 'dtep_status')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit_id']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $form = ActiveForm::begin();
    $form->field($model, 'dept_created_date')->widget(DatePicker::className(),[
   'name' => 'dept_created_date',
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
]) ?>




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

</script>