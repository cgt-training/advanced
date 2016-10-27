<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = $model->c_id;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$img_path = Yii::$app->request->baseUrl . '/frontend/web/uploads/';
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['/',], ['class' => 'btn btn-primary','id'=>"company_id"]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'c_id',
            'c_name',
            'c_email:email',
            'c_add:ntext',
            'c_start_date',
            'c_create_date',
            'c_status',
            'c_logo',
            [
                'attribute'=>'c_logo',
                'value'=>$img_path.$model->c_logo,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
        ],
    ]) ?>

</div>


<script type="text/javascript">

  $("#company_id").click({url_link: "company"}, load_data);

  // in your function, just grab the event object and go crazy...
  function load_data(event){
      //var url = event.data.url;
      $.ajax({
            url: event.data.url_link, 
            type:"post",

           success: function(result){
            //$.pjax.reload({ container: '#pjax_main_container'});
            $("#pjax_main_container").html(result);
            return false;
        }});
      return false;
  }

</script>