<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

<?php
    
    if (Yii::$app->user->isGuest) {
        $Action_Column_Var = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'dept_id',
                                [
                                    'attribute'=>'c_id',
                                    'value'=>'c.c_name',
                                ],
                                [
                                    'attribute'=>'b_id',
                                    'value'=>'b.br_name',
                                ],
                                'dept_name',
                                'dept_created_date',
                             ];   
    }
    else
    {
        ?>
        <p>
            <?php /*Html::a('Create Department', ['create'], ['class' => 'btn btn-success']) */?>
        </p>

        <?= Html::button('Create Department', ['value'=>Url::toRoute('department/create'), 'class' => 'btn btn-success', 
                                                    'id'=>'modalButton' ]) ?>


         <?php
            Modal::begin([
                    'header'=>'<h4>Departments</h4>',
                    'id'=>'modal',
                    'size'=>'modal-lg',
                ]);
            echo "<div id='modalContent'></div>";
            Modal::end();

        $Action_Column_Var =    
                            [
                                ['class' => 'yii\grid\SerialColumn'],
                                'dept_id',
                                [
                                    'attribute'=>'c_id',
                                    'value'=>'c.c_name',
                                ],
                                [
                                    'attribute'=>'b_id',
                                    'value'=>'b.br_name',
                                ],
                                'dept_name',
                                'dept_created_date',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url,$model,$key) {
                                            return 
                                                Html::a(
                                                '<i class="fa fa-eye fa-3"></i>',
                                                '#',
                                                [
                                                    'title' => 'View',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('department/view/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('department/update/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('department/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ];
    }
    
?>

<?php Pjax::begin(['id' => 'departmentPjax']); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $Action_Column_Var,
    ]); ?>
<?php Pjax::end(); ?></div>

<script type="text/javascript">
    $('#modalButton').click(function(){
    $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
});

</script>