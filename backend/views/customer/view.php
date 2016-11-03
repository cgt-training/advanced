<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = "Detail View for ".$model->cust_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view" style="width:50%;margin:0 auto;">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Back', ['/customer',], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cust_name',
            'zip_code',
            'city',
            'province',
        ],
    ]) ?>

</div>
