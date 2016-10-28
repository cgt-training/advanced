<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locations List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index" style="margin:15px;">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if (Yii::$app->user->isGuest) {
        $Action_Column_Var = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'zip_code',
                                'city',
                                'province',
                            ];
    }
    else{
        ?>
            <p>
                <?php 
                    /*Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) */?>
                <?= Html::button('Create Location', ['value'=>Url::toRoute('location/create'), 'class' => 'btn btn-success',
                                    'id'=>'modalButton' ]) ?>
            </p>
            <?php
                Modal::begin([
                        //'header'=>'<h4>Location</h4>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
          
          $Action_Column_Var = 
                                [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'zip_code',
                                    'city',
                                    'province',
                                    [
                                    'class' => 'yii\grid\ActionColumn',
                                    /*'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<i class="fa fa-eye fa-3"></i>',
                                                '#',
                                                [
                                                    'title' => 'View',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('location/view/?id=".$key."');return false;",
                                                ]
                                            );
                                        },
                                        'update' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<i class="fa fa-pencil-square-o fa-3"></i>',
                                                '#', 
                                                [
                                                    'title' => 'Update',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('location/update/?id=".$key."');return false;",
                                                ]
                                            );
                                        },
                                        'delete' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<i class="fa fa-trash fa-3"></i>',
                                                '#', 
                                                [
                                                    'title' => 'Delete',
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                    'onclick' => "load_data_new('location/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],*/
                                ]
                            ];
    }
    ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => $Action_Column_Var,
                                                ]); 
                            ?>
<?php Pjax::end(); ?></div>