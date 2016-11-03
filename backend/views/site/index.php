<?php

  $img_path = Yii::$app->request->baseUrl . '/backend/web';
  /* @var $this yii\web\View */

  $this->title = 'My Yii Application';
?>
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    
    <section class="content">
    
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $company_count;?></h3>

              <p>Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" id='comp_more' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $branch_count;?></h3>
              <p>Branches</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" id='branch_more' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $department_count;?></h3>
              <p>Department</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" id='dept_more' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
        
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $customer_count;?></h3>
              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" id='cust_more' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      
      <div class="row">
      
        <section class="col-lg-7 connectedSortable">
          <div class="box box-info text-center">
            <h3 class="text-center">Welcome to DashBoard</h3>
          </div>
          <div class="row">
            <div class="col-md-12">&nbsp;</div>
          </div>
          <div id="com_div" style="display:none;">
            <h3>Company Listing</h3>
            <table id="company_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Company Name</th>
                  <th>Company Email</th>
                  <th>Company Address</th>
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
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
              </tbody>
            </table>
          </div>
          <div id="branch_div" style="display:none;">
              <h3>Branch Listing</h3>
              <table id="branch_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Branch Name</th>
                  <th>Company</th>
                  <th>Address</th>
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
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
          </div>
          <div id="dept_div" style="display:none;">
              <h3>Department Listing</h3>
              <table id="dept_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Department Name</th>
                  <th>Company</th>
                  <th>Branch Name</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $iSrno = 1;

                foreach ($Department_Arr as $key => $Dept_Sub_Arr) {
                  ?>
                    <tr>
                      <td><?php echo $iSrno++;?></td>
                      <td><?php echo $Dept_Sub_Arr->dept_name;?></td>
                      <td><?php echo $Dept_Sub_Arr['company']->c_name;?></td>
                      <td><?php echo $Dept_Sub_Arr['branch']->br_name;?></td>
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
          </div>
          <div id="cust_div" style="display:none;">
              <h3>Customer Listing</h3>
              <table id="cust_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customer Name</th>
                  <th>Zip Code</th>
                  <th>City</th>
                  <th>Province</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $iSrno = 1;

                foreach ($Customer_Arr as $key => $Cust_Sub_Arr) {
                  ?>
                    <tr>
                      <td><?php echo $iSrno++;?></td>
                      <td><?php echo $Cust_Sub_Arr->cust_name;?></td>
                      <td><?php echo $Cust_Sub_Arr->zip_code;?></td>
                      <td><?php echo $Cust_Sub_Arr->city;?></td>
                      <td><?php echo $Cust_Sub_Arr->province;?></td>
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
          </div>

        </section>
        
        <section class="col-lg-5 connectedSortable">
          
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
          
              <div class="pull-right box-tools">
          
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
          
            </div>
          
            <div class="box-body no-padding">
          
              <div id="calendar" style="width: 100%"></div>
            </div>
          
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
          
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
          
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
          
              </div>
          
            </div>
          </div>
          

        </section>
        
      </div>
    </section>