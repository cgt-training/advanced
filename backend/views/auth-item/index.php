<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchAuthItem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles Listing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index" style="margin-left:15px;">

    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo  Html::button('Create Permission', ['value'=>Url::toRoute('auth-item/create'), 'class' => 'btn btn-success', 
                                                'id'=>'modalButton' ]) ?>
        <?php echo Html::a('Assign Rights', ['assignright'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        Modal::begin([
                //'header'=>'<h4>Branches</h4>',
                'id'=>'modal',
                'size'=>'modal-md',
            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
<?php /*Pjax::begin(); ?>    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'type',
            'description:ntext',
            //'rule_name',
            //'data:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); */?>


<div class="box">
    <!-- /.box-header -->
        <div class="box-body">
          <table id="auth_table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>S.No</th>
              <th>Role</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $iSrno = 1;

            foreach ($AuthUsers as $key => $Auth_Sub_Arr) {
              ?>
                <tr>
                  <td><?php echo $iSrno++;?></td>
                  <td><?php echo $Auth_Sub_Arr->name;?></td>
                  <td><?php echo $Auth_Sub_Arr->description;?></td>
                  <td>
                  <?php
                      echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/auth-item/view/','id'=>$Auth_Sub_Arr->name]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/auth-item/update/','id'=>$Auth_Sub_Arr->name]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/auth-item/delete', 'id' => $Auth_Sub_Arr->name], [
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
    $('#auth_table').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    });
  });");?>
