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
<div class="department-view" style="width:50%;margin:0 auto;">

    <h1 style="margin:15px;"><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Index', ['/department',], ['class' => 'btn btn-primary','id'=>"company_id"]) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'c.c_name',
            'b.br_name',
            'dept_name',
            'dept_created_date',
            'dtep_status',
        ],
    ]) 
    ?>




</div>
