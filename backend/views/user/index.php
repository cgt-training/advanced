<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Listing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index" style="margin-left:15px;">
    <h2><?php echo  Yii::$app->session->getFlash('response_msg'); ?></h2>
    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
                <?php 
                    /*Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) */?>
                <?php /*Html::button('Create User', ['value'=>Url::toRoute('user/create'), 'class' => 'btn btn-success',
                                    'id'=>'modalButton' ]) */?>
    </p>
    <?php
                /*Modal::begin([
                        //'header'=>'<h5>Companies</h5>',
                        'id'=>'modal',
                        'size'=>'modal-md',
                    ]);
                echo "<div id='modalContent'></div>";
                Modal::end();*/
    ?>

<?php /*Pjax::begin(); ?>    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            // 'email:email',
             'role',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); */?>



    <div class="box">
    <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>S.No</th>
              <th>Username</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $iSrno = 1;

            foreach ($Users_Arr as $key => $Users_Sub_Arr) {

              ?>
                <tr>
                  <td><?php echo $iSrno++;?></td>
                  <td><?php echo $Users_Sub_Arr->username;?></td>
                  <td><?php echo $Users_Sub_Arr->role;?></td>
                  <td>
                  <?php
                      echo Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['/user/view/','id'=>$Users_Sub_Arr->id]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/update/','id'=>$Users_Sub_Arr->id]);
                      echo "&nbsp;&nbsp;";
                      echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/user/delete', 'id' => $Users_Sub_Arr->id], [
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
