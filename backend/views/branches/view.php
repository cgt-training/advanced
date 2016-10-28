<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = "Detail View for ".$model->br_name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-view" style="margin:15px;">

    <h1 style="margin:15px;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['/branches',], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'b_id',
            'c_id',
            'br_name',
            'br_address:ntext',
            'br_created',
            'br_status',
        ],
    ]) ?>

</div>
