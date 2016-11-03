<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = "Detail View for ".$model->c_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$img_path = Yii::$app->request->baseUrl . '/uploads/';
?>
<div class="company-view" style="width:70%;margin:0 auto;">

    <h1 class="margin-default" style="margin:15px;"><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Back', ['/company',], ['class' => 'btn btn-primary','id'=>"company_id"]) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'c_id',
            'c_name',
            'c_email:email',
            'c_add:ntext',
            'c_start_date',
            'c_create_date',
            'c_status',
            [
                'attribute'=>'c_logo',
                'value'=>$img_path.$model->c_logo,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
        ],
    ]) ?>

</div>