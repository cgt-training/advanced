<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="branches-index" id='branch-index'>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php
    if (Yii::$app->user->isGuest) {
        $Action_Column_Var = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'b_id',
                                'br_name',
                                [
                                    'attribute'=>'c_id',
                                    'value'=>'c.c_name',
                                ],
                                'br_address:ntext',
                                'br_created',
                            ];   
    }
    else{
        ?>
            <p>
                <?php 
                    /*Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) */
                ?>
                <?= Html::button('Create Branches', ['value'=>Url::toRoute('branches/create'), 'class' => 'btn btn-success', 
                                                        'id'=>'modalButton' ]) ?>
            </p>

            <?php
                Modal::begin([
                        'header'=>'<h4>Branches</h4>',
                        'id'=>'modal',
                        'size'=>'modal-lg',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
           
        $Action_Column_Var = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'b_id',
                                    'br_name',
                                    [
                                        'attribute'=>'c_id',
                                        'value'=>'c.c_name',
                                    ],
                                    'br_address:ntext',
                                    'br_created',
                                    [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<i class="fa fa-pencil-square-o fa-5"></i>',
                                                '#', 
                                                [
                                                    'title' => 'View',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('branches/view/?id=".$key."')",
                                                ]
                                            );
                                        },
                                        'update' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<i class="fa fa-eye fa-3"></i>',
                                                '#', 
                                                [
                                                    'title' => 'Update',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('branches/update/?id=".$key."')",
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
                                                    'onclick' => "load_data_new('branches/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],
                                ],
                            ];
    }
?>
<?php Pjax::begin(['id' => 'branchPjax']); ?>    
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