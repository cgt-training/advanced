<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = 'Create Department';
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'List_Company_Arr' => $List_Company_Arr,
         'List_Branches_Arr' => $List_Branches_Arr,
    ]) ?>

</div>


<?php
     $this->registerJsFile('@jspath/main.js',['depends' => [yii\web\JqueryAsset::className()]]);
?>
