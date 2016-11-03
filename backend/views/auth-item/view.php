<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\AuthItem */

$this->title = "Detail View of ".$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view" style="width:50%;margin:0 auto;">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Back', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
