<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = "Detail View for ".$model->br_name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-view" style="width:50%; margin:0 auto;">

    <h1 "><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Back', ['/branches',], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo  DetailView::widget([
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
