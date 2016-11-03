<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Create Company';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create" style="margin-left:15px;">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'modelCompany' => $model,
        'modelBranches' => $modelBranches,
    ]) ?>

</div>
