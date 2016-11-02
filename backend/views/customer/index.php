<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index" style="margin:15px;">
    <h2><?= Yii::$app->session->getFlash('response_msg'); ?></h2>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

       
<?php
/*
    if (Yii::$app->user->isGuest) {
        $Action_Column_Var = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'cust_name',
                                'zip_code',
                                'city',
                                'province',
                            ];
    }
    else{
        */
        ?>
            <p>
                <?php 
                    Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::button('Create Customer', ['value'=>Url::toRoute('customer/create'), 'class' => 'btn btn-success',
                                    'id'=>'modalButton' ]) ?>
            </p>
            <?php
                Modal::begin([
                        'header'=>'<h3>Create Customer</h3>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
          /*
          $Action_Column_Var = 
                                [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'cust_name',
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
                                                    'onclick' => "load_data_new('customer/view/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('customer/update/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('customer/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ];
    }
?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $Action_Column_Var,
    ]); ?>
<?php Pjax::end(); */?>

<div class="box-body">
      <table id="cust_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>S.No</th>
          <th>Customer Name</th>
          <th>Zip Code</th>
          <th>City</th>
          <th>Province</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $iSrno = 1;

        foreach ($Customer_Arr as $key => $Cust_Sub_Arr) {
          ?>
            <tr>
              <td><?=$iSrno++;?></td>
              <td><?=$Cust_Sub_Arr->cust_name;?></td>
              <td><?=$Cust_Sub_Arr->zip_code;?></td>
              <td><?=$Cust_Sub_Arr->city;?></td>
              <td><?=$Cust_Sub_Arr->province;?></td>
              <td>
              <?php
                  echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/customer/view/','id'=>$Cust_Sub_Arr->cust_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/customer/update/','id'=>$Cust_Sub_Arr->cust_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/customer/delete', 'id' => $Cust_Sub_Arr->cust_id], [
                          'class' => '',
                          'data' => [
                              'confirm' => 'Are you sure ? want to delete.',
                              'method' => 'post',
                          ],
                      ]);
                  ?>
                  </td>
                </tr>
              <?php
        }
        ?>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
<!-- /.box-body -->
</div>

</div>

<?= $this->registerJsFile('@Pluginpath/datatables/jquery.dataTables.min.js',['depends' => [yii\web\JqueryAsset::className()]]);?>
<?= $this->registerJsFile('@Pluginpath/datatables/dataTables.bootstrap.min.js',['depends' => [yii\web\JqueryAsset::className()]]);?>

<?= $this->registerJs("
  $(function () {
    $('#cust_table').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>
