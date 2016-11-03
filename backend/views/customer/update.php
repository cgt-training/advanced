<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = 'Update Customer: ' . $model->cust_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cust_id, 'url' => ['view', 'id' => $model->cust_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <?php echo  $this->render('_form', [
        'model' => $model,
        'List_Location_Arr' => $List_Location_Arr,
    ]) ?>

</div>
