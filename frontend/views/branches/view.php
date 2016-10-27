<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = $model->b_id;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['/',], ['class' => 'btn btn-primary','id'=>"company_id"]) ?>
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
