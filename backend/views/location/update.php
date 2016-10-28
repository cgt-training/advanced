<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Location */

$this->title = 'Update Location: ' . $model->city;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loc_id, 'url' => ['view', 'id' => $model->loc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
