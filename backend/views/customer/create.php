<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

$this->title = 'Create Customer';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <?php echo  $this->render('_form', [
        'model' => $model,
        'List_Location_Arr' => $List_Location_Arr,
    ]) ?>

</div>
