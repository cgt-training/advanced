<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = "Detail View for ".$model->cust_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view" style="margin:15px;">

    <h1 style="margin:15px;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['/customer',], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cust_id',
            'cust_name',
            'zip_code',
            'city',
            'province',
        ],
    ]) ?>

</div>
