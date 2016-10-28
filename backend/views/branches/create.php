<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */

$this->title = 'Create Branches';
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-create">

    <?= $this->render('_form', [
        'model' => $model,
        'List_Company_Arr'=>$List_Company_Arr,
    ]) ?>

</div>
