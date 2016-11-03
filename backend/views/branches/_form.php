<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
//use kartik\select2-master\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
$Style_Var = $model->isNewRecord ? 'width:100%; margin:0 auto;' : 'width:50%; margin:0 auto;';
$Title_Val = $model->isNewRecord ? '' : "<h1>".Html::encode($this->title)."</h1>";
?>

<div class="branches-form" style="<?php echo $Style_Var;?>">
    <?php echo  $Title_Val ?>
    <?php $form = ActiveForm::begin(['id' => 'branches_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>

    <div class="box-body">

    <?php
       /* echo $form->field($model, 'c_id')->widget(Select2::classname(), [
        'data' => $List_Company_Arr,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
      ]);*/
      //echo "<pre>";
      //print_r($List_Company_Arr);

      echo Html::hiddenInput('b_id', '');
      echo Html::hiddenInput('br_created', date('Y-m-d H:i:s'));
    ?>

    <?php echo  $form->field($model, 'c_id', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                    'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                                ])->dropDownList($List_Company_Arr, ['prompt' => 'Select Company','class'=>'form-control select2','style'=>"width: 100%;"])?>

    <?php echo  $form->field($model, 'br_name', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Name']) ?>

    <?php echo  $form->field($model, 'br_address', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3']
                                        ])->textarea(['rows' => 4,'placeholder'=>'Address']) ?>

    <?php echo  $form->field($model, 'br_status', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                                'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                            ])->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Select Staus','class'=>'form-control select2','style'=>"width: 100%;"])?>

    <div class="form-group col-sm-12 text-center">
        <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?php echo  Html::a('Cancel', ['/branches/'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

<?php echo  $this->registerJs("$('.select2').select2();");?>

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