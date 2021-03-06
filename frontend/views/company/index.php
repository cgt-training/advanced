<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     
<?php
    if (Yii::$app->user->isGuest) {
        $Action_Column_Var = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'c_id',
                                'c_name',
                                'c_email:email',
                                'c_add:ntext',
                                'c_start_date',
                            ];
    }
    else{
        ?>
            <p>
                <?php 
                    /*Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) */?>
                <?= Html::button('Create Company', ['value'=>Url::toRoute('company/create'), 'class' => 'btn btn-success',
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
          
          $Action_Column_Var = 
                                [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'c_id',
                                    'c_name',
                                    'c_email:email',
                                    'c_add:ntext',
                                    'c_start_date',
                                    [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                                '#',
                                                [
                                                    'title' => 'View',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('company/view/?id=".$key."');return false;",
                                                ]
                                            );
                                        },
                                        'update' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<span class="glyphicon glyphicon-pencil"></span>',
                                                '#', 
                                                [
                                                    'title' => 'Update',
                                                    'data-pjax' => '0',
                                                    'onclick' => "load_data_new('company/update/?id=".$key."');return false;",
                                                ]
                                            );
                                        },
                                        'delete' => function ($url,$model,$key) {
                                            return Html::a(
                                                '<span class="glyphicon glyphicon-trash"></span>',
                                                '#', 
                                                [
                                                    'title' => 'Delete',
                                                    'data-pjax' => '0',
                                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                    'onclick' => "load_data_new('company/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ];
    }
?>

<?php Pjax::begin(['id'=>'companyPjax']); ?>
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