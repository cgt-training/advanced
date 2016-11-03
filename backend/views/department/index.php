<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index" style="margin:15px;">
<h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>
    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p><?php echo  Html::button('Create Department', ['value'=>Url::toRoute('department/create'), 'class' => 'btn btn-success', 
                                                    'id'=>'modalButton' ]) ?>
</p>

         <?php
        
            Modal::begin([
                    'header'=>'<h3>Create Department</h3>',
                    'id'=>'modal',
                    'size'=>'modal-md',
                ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
/*
        $Action_Column_Var =    
                            [
                                ['class' => 'yii\grid\SerialColumn'],
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
                                    /*'template' => '{view} {update} {delete}',
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
    
    
?>

<?php Pjax::begin(['id' => 'departmentPjax']); ?>    
<?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $Action_Column_Var,
    ]); ?>
<?php Pjax::end(); */?>

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="dept_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>S.No</th>
          <th>Department Name</th>
          <th>Company</th>
          <th>Branch Name</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $iSrno = 1;

        foreach ($Department_Arr as $key => $Dept_Sub_Arr) {

          //echo "<pre>";
          //print_r($Dept_Sub_Arr);



          ?>
            <tr>
              <td><?php echo $iSrno++;?></td>
              <td><?php echo $Dept_Sub_Arr->dept_name;?></td>
              <td><?php echo $Dept_Sub_Arr['company']->c_name;?></td>
              <td><?php echo $Dept_Sub_Arr['branch']->br_name;?></td>
              <td>
              <?php
                  echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/department/view/','id'=>$Dept_Sub_Arr->dept_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/department/update/','id'=>$Dept_Sub_Arr->dept_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/department/delete', 'id' => $Dept_Sub_Arr->dept_id], [
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



<?php echo  $this->registerJsFile('@Pluginpath/datatables/jquery.dataTables.min.js',['depends' => [yii\web\JqueryAsset::className()]]);?>
<?php echo  $this->registerJsFile('@Pluginpath/datatables/dataTables.bootstrap.min.js',['depends' => [yii\web\JqueryAsset::className()]]);?>

<?php echo  $this->registerJs("
  $(function () {
    $('#dept_table').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>
