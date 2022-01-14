

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add New Member
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Member</li>
      </ol>
    </section>
<section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

         
            <form role="form" action="<?php base_url('Controller_Members/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                <div class="row">
                
                <div class="form-group">
                  <div class="col-md-4">
                    <label for="groups">Permission</label>
                    <select class="form-control" id="groups" name="groups">
                      <option value="">Select Permission</option>
                      <?php foreach ($group_data as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="fname">First name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="lname">Last name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
                  </div>
                </div>
               
                <div class="form-group">
                  <div class="col-md-4">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="company_id">Company Name</label>
                    <!-- <input type="text" class="form-control" id="company_id" name="company_id" placeholder="Company Name" autocomplete="off"> -->
                    <select class="form-control" id="company_id" name="company_id">
                      <option value="">Select Company</option>
                      <?php foreach ($company_data as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['company_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="mobile">Mobile No</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Confirm Password" autocomplete="off">
                  </div>
                  
                  
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="employee_code">Employee Code</label>
                    <input type="text" class="form-control" id="employee_code" name="employee_code" placeholder="Enter Employee Code" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="phone">Telephone No</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="cpassword">Confirm password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                  </div>
                  
                  <div class="col-md-4">
                    <label for="emp_designation">Employee Designation</label>
                    <input type="text" class="form-control" id="emp_designation" name="emp_designation" placeholder="Enter Employee Code" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                  </div>                  
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="address">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter address" autocomplete="off"></textarea>
                  </div>
                  
                  <div class="col-md-4">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off"></textarea>
                  </div>  
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save & Close</button>
                <a href="<?php echo base_url('Controller_Members/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->

 

    </section>