<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         User Permission        
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Permission</li>
      </ol>
   </section>
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <div class="box-header with-border">
            <!-- <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
               </div> -->
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
                  <form role="form" action="<?php base_url('Controller_Permission/create') ?>" method="post">
                     <div class="box-body">
                        <!-- <?php echo validation_errors(); ?> -->
                        
                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group" >
                           <label for="group_name">Permission Name  <span class="required">*</span></label>
                           <input type="text" class="form-control" id="group_name" name="group_name"  required placeholder="Enter Permission Name">
                        </div>
                        
                        <label><input type="checkbox" name="selectall" class="selectall"/>  Select All to create Superadmin Role </label>

                        <div class="form-group">
                           <!-- <label for="permission">Permission</label> -->
                           <table class="table table-responsive">
                              <thead>
                                 <tr>
                                    <th>Module Name / Permission </th>
                                    <th>Module</th>
                                    <th>View</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th>Assign To</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Dashboard</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleDashboard" class="minimal"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Customer</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleCustomer" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewCustomer" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createCustomer" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateCustomer" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteCustomer" class="minimal"></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Products</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleProduct" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                                    <td></td>
                                 </tr>

                                 <tr>
                                    <td>Products Type</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleProductType" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewProductType" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createProductType" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateProductType" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteProductType" class="minimal"></td>
                                    <td></td>
                                 </tr>

                                 <tr>
                                    <td>Department</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleDepartment" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewDepartment" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createDepartment" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateDepartment" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteDepartment" class="minimal"></td>
                                    <td></td>
                                 </tr>

                                 <tr>
                                    <td>Company</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleCompany" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewCompany" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createCompany" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteCompany" class="minimal"></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Inquiry</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleInquiry" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewInquiry" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createInquiry" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateInquiry" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteInquiry" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="assigntoInquiry"></td>
                                 </tr>
                                 <tr>
                                    <td>Members</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleUser" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Permission</td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="moduleGroup" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                                    <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                                    <td></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- /.box-body -->
                     <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save & Close</button>
                        <a href="<?php echo base_url('Controller_Permission/') ?>" class="btn btn-warning">Back</a>
                     </div>
                  </form>
               </div>
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

<script type="text/javascript">
$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('div input').attr('checked', true);
    } else {
        $('div input').attr('checked', false);
    }
});
</script>