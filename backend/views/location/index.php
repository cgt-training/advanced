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
    <h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>
    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?php 
                    /*Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) */?>
                <?php echo  Html::button('Create Location', ['value'=>Url::toRoute('location/create'), 'class' => 'btn btn-success',
                                    'id'=>'modalButton' ]) ?>
            </p>
            <?php
                Modal::begin([
                        'header'=>'<h3>Create Location</h3>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
          
         /* $Action_Column_Var = 
                                [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'zip_code',
                                    'city',
                                    'province',
                                    ['class' => 'yii\grid\ActionColumn',]
                                ];
    
    ?>
<?php Pjax::begin(); ?>    <?php echo  GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => $Action_Column_Var,
                                                ]); 
                            ?>
<?php Pjax::end(); */?>


<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>S.No</th>
          <th>Zip Code</th>
          <th>City(s)</th>
          <th>Province</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $iSrno = 1;

        foreach ($Locations_Data as $key => $Locations_Data_Sub_Arr) {

          ?>
            <tr>
              <td><?php echo $iSrno++;?></td>
              <td><?php echo $Locations_Data_Sub_Arr->zip_code;?></td>
              <td><?php echo $Locations_Data_Sub_Arr->city;?></td>
              <td><?php echo $Locations_Data_Sub_Arr->province;?></td>
              <td>
              <?php
              echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/location/view/','id'=>$Locations_Data_Sub_Arr->loc_id]);
              echo "&nbsp;&nbsp;";
              echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/location/update/','id'=>$Locations_Data_Sub_Arr->loc_id]);
              echo "&nbsp;&nbsp;";
              echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/location/delete', 'id' => $Locations_Data_Sub_Arr->loc_id], [
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
    $('#example1').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>