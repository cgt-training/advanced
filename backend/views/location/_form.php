<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Location */
/* @var $form yii\widgets\ActiveForm */

$Style_Var = $model->isNewRecord ? 'width:100%; margin:0 auto;' : 'width:50%; margin:0 auto;';
$Title_Val = $model->isNewRecord ? '' : "<h1>".Html::encode($this->title)."</h1>";
?>

<div class="location-form" style="<?php echo $Style_Var;?>">

    <?php $form = ActiveForm::begin(['id' => 'location_form_id','options' => ['enctype' => 'multipart/form-data','class'=>'form-horizontal']]); ?>

    <?php echo $Title_Val;?>

    <div class="box-body">

        <?php echo  $form->field($model, 'zip_code', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Zip Code']) ?>

        <?php echo  $form->field($model, 'city', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'City']) ?>

        <?php echo  $form->field($model, 'province', ['template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label col-sm-3',]
                                        ])->textInput(['maxlength' => true,'placeholder'=>'Province']) ?>

        <div class="form-group col-sm-12 text-center">
            <?php echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submit_id']) ?>
            <?php echo  Html::a('Cancel', ['/location/'], ['class'=>'btn btn-danger']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
/*
var url_data = "location/create";

if($('#location-loc_id').val())
  var url_data = "location/update?id="+$('#location-loc_id').val();

  $('#submit_id').click(function(){
    $.ajax({
        url: url_data, 
        type:"post",

        //data: $('#company_form_id').serialize(),
        data: $('#location_form_id').serialize(),

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
