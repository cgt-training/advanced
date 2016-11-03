<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches List';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="branches-index" id='branch-index' style="margin:15px;">
    <h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>
    <h1><?php echo  Html::encode($this->title) ?></h1>

     <p>
          <?php echo  Html::button('Create Branches', ['value'=>Url::toRoute('branches/create'), 'class' => 'btn btn-success', 
                                                  'id'=>'modalButton' ]) ?>
      </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 

                Modal::begin([
                        'header'=>'<h3>Create Branch</h3>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
/*           
        $Action_Column_Var = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'br_name',
                                    ['attribute'=>'c_id','value'=>'c.c_name',],
                                    'br_address:ntext',
                                    'br_created',
                                    ['class' => 'yii\grid\ActionColumn',],
                            ];
    
?>
<?php Pjax::begin(['id' => 'branchPjax']); ?>    
<?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $Action_Column_Var,
    ]); ?>

<?php Pjax::end(); */?>

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="branch_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>S.No</th>
          <th>Branch Name</th>
          <th>Company</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $iSrno = 1;

        foreach ($Branches_Arr as $key => $Branch_Sub_Arr) {
          ?>
            <tr>
              <td><?php echo $iSrno++;?></td>
              <td><?php echo $Branch_Sub_Arr->br_name;?></td>
              <td><?php echo $Branch_Sub_Arr['company']->c_name;?></td>
              <td><?php echo $Branch_Sub_Arr->br_address;?></td>
              <td>
              <?php
                  echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/branches/view/','id'=>$Branch_Sub_Arr->b_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/branches/update/','id'=>$Branch_Sub_Arr->b_id]);
                  echo "&nbsp;&nbsp;";
                  echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/branches/delete', 'id' => $Branch_Sub_Arr->b_id], [
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
    $('#branch_table').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>
