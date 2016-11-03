<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = 'Update Branch: ' . $model->br_name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b_id, 'url' => ['view', 'id' => $model->b_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branches-update">

    <?php echo  $this->render('_form', [
        'model' => $model,
        'List_Company_Arr' => $List_Company_Arr,
    ]) ?>

</div>
