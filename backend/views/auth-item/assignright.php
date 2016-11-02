<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AuthItem */

$this->title = 'Assign Role';
$this->params['breadcrumbs'][] = ['label' => 'Assign Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_assign-form', [
        'modelAuthItem' => $model,
        'Auth_Item_Child_Arr' => $Auth_Item_Child_Arr,
        'modelAuthItemChild' => $modelAuthItemChild,
    ]) ?>

</div>
