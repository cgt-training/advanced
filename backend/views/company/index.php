<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;

$img_path = Yii::$app->request->baseUrl . '/uploads/';

?>
<div class="company-index" style="margin-left:15px;">
<h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>

    <h1><?php echo  Html::encode('Companies List') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     
<?php
    
        ?>
            <p>
                <?php echo Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
                
                <?php /* Html::button('Create Company', ['value'=>Url::toRoute('company/create'), 'class' => 'btn btn-success' ]) */?>
            </p>
            <?php
                /*Modal::begin([
                        //'header'=>'<h5>Companies</h5>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();*/
          
          /*$Action_Column_Var = 
                                [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'c_name',
                                    'c_email:email',
                                    'c_add:ntext',
                                    'c_start_date',
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
                                                    'onclick' => "load_data_new('company/view/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('company/update/?id=".$key."');return false;",
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
                                                    'onclick' => "load_data_new('company/delete/?id=".$key."')",
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ];

//echo "<pre>";
    //print_r($dataProvider);
    //print_r($searchModel);
?>

<?php Pjax::begin(['id'=>'companyPjax']); ?>
        <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $Action_Column_Var,
    ]); ?>
<?php Pjax::end(); 

*/?>


 <div class="box">
    <!-- /.box-header -->
        <div class="box-body">
          <table id="company_table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>S.No</th>
              <th>Company Name</th>
              <th>Company Email</th>
              <th>Company Address</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $iSrno = 1;

            foreach ($Company_Arr as $key => $Company_Sub_Arr) {
              ?>
                <tr>
                  <td><?php echo $iSrno++;?></td>
                  <td><?php echo $Company_Sub_Arr->c_name;?></td>
                  <td><?php echo $Company_Sub_Arr->c_email;?></td>
                  <td><?php echo $Company_Sub_Arr->c_add;?></td>
                  <td>
                  <?php
                      echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/company/view/','id'=>$Company_Sub_Arr->c_id]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/company/update/','id'=>$Company_Sub_Arr->c_id]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/company/delete', 'id' => $Company_Sub_Arr->c_id], [
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
    $('#company_table').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>
