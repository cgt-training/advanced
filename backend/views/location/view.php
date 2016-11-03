<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Location */

$this->title = "Detail View for ".$model->city;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view" style="width:50%;margin:0 auto;">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Back', ['/location',], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'loc_id',
            'zip_code',
            'city',
            'province',
        ],
    ]) ?>

</div>
