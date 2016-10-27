<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Location */

$this->title = 'Update Location: ' . $model->loc_id;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loc_id, 'url' => ['view', 'id' => $model->loc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
