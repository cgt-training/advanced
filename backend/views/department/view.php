<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = "Detail View for ".$model->dept_name;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view" style="margin:15px;">

    <h1 style="margin:15px;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Index', ['/',], ['class' => 'btn btn-primary','id'=>"company_id"]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dept_id',
            'c.c_name',
            'b.br_name',
            'dept_name',
            'dept_created_date',
            'dtep_status',
        ],
    ]) 
    ?>




</div>
