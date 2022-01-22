<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Update Members
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Members</li>
      </ol>
   </section>
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <!-- <div class="box-header with-border">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
            </div> -->
         <!-- /.box-header -->
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
                              <label for="fname">Employee First Name <span class="requiredFiled">*</span></label>
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="Employee First Name" required value="<?php echo $user_data['firstname'] ?>" autocomplete="off">
                           </div>
                           <div class="col-md-4">
                              <label for="lname">Employee Last name <span class="requiredFiled">*</span></label>
                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Employee Last name" value="<?php echo $user_data['lastname'] ?>" autocomplete="off">
                           </div>

                           <div class="col-md-4">
                              <label for="mobile">Mobile No <span class="requiredFiled">*</span></label>
                              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile Number" required value="<?php echo $user_data['mobile'] ?>" autocomplete="off">
                           </div>

                        </div>
                        <div class="form-group">

                           <div class="col-md-4">
                              <label for="employee_code">Employee Code <span class="requiredFiled">*</span></label>
                              <input type="text" class="form-control" id="employee_code" name="employee_code" placeholder="Enter Employee Code" value="<?php echo $user_data['emp_code'] ?>" autocomplete="off">
                           </div>

                           <div class="col-md-4">
                              <label for="emp_designation">Employee Designation</label>
                              <input type="text" class="form-control" id="emp_designation" name="emp_designation" placeholder="Enter Employee Designation" value="<?php echo $user_data['designation'] ?>"  autocomplete="off">
                           </div>

                           <div class="col-md-4">
                              <label for="email">Email <span class="requiredFiled">*</span></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo $user_data['email'] ?>" autocomplete="off">
                           </div>
                        </div>
                        <div class="form-group">

                           <div class="col-md-4">
                              <label for="company_id">Company Name <span class="requiredFiled">*</span></label>
                              <select class="form-control" id="company_id" required name="company_id">
                                 <option value="">Select Company</option>
                                 <?php foreach ($company_data as $k => $v): ?>
                                 <option value="<?php echo $v['id'] ?>" <?php if($user_data['company_id'] == $v['id']) { echo 'selected'; } ?>><?php echo $v['company_name'] ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="phone">Telephone No</label>
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user_data['phone'] ?>" autocomplete="off">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                     <div class="form-group">
                          <div class="col-md-4">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $user_data['username'] ?>" autocomplete="off">
                           </div>

                           <div class="col-md-4">
                              <label for="password">Password</label>
                              <input type="text" class="form-control" id="password" name="password" placeholder="Password"  autocomplete="off">
                           </div>

                           <div class="col-md-4">
                              <label for="cpassword">Confirm password</label>
                              <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-4">
                              <label for="address">Address <span class="requiredFiled">*</span></label>
                              <textarea type="text" class="form-control" id="address" name="address"  placeholder="Enter address" value="<?php echo $user_data['address'] ?>" autocomplete="off"><?php echo $user_data['address'] ?></textarea>
                           </div>

                           <div class="col-md-4">
                              <label for="notes">Notes</label>
                              <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" value="<?php echo $user_data['notes'] ?>" autocomplete="off"><?php echo $user_data['notes'] ?></textarea>
                           </div>
                           <div class="col-md-4">
                              <label for="groups">Permission <span class="requiredFiled">*</span></label>
                              <select class="form-control" id="groups" required name="groups">
                                 <option value="">Select Permission</option>
                                 <?php foreach ($group_data as $k => $v): ?>
                                 <option value="<?php echo $v['id'] ?>" <?php if($user_group['id'] == $v['id']) { echo 'selected'; } ?>><?php echo $v['group_name'] ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                        </div>
                    </div>
                  </div> 
                     <!-- /.box-body -->
                     <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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
      <!-- /.row -->
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</section>
<script type="text/javascript">
   $(document).ready(function() {
     $("#groups").select2();
   
     $("#mainUserNav").addClass('active');
     $("#manageUserNav").addClass('active');
   });
</script>