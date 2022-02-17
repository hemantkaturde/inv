<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Manage Permission
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url('Controller_Permission/') ?>">Permission</a></li>
         <li class="active">Edit</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
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
            <div class="box">
               <div class="box-header">
               </div>
               <form role="form" action="<?php base_url('Controller_Permission/update') ?>" method="post">
                  <div class="box-body">
                     <?php echo validation_errors(); ?>
                     <div class="form-group">
                        <label for="group_name">Permission Name</label>
                        <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter permission name" value="<?php echo $group_data['group_name']; ?>">
                     </div>

                     <label><input type="checkbox" name="selectall" class="selectall"/>  Select All to create Superadmin Role </label>

                     <div class="form-group">
                        <!-- <label for="permission">Permission</label> -->
                        <?php $serialize_permission = unserialize($group_data['permission']); ?>
                        <table class="table table-responsive">
                           <thead>
                              <tr>
                                    <th></th>
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
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleDashboard" <?php if($serialize_permission) {
                                    if(in_array('moduleDashboard', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>

                              <tr>
                                 <td>Customer</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleCustomer" <?php if($serialize_permission) {
                                    if(in_array('moduleCustomer', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCustomer" <?php if($serialize_permission) {
                                    if(in_array('viewCustomer', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCustomer" <?php if($serialize_permission) {
                                    if(in_array('createCustomer', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCustomer" <?php if($serialize_permission) {
                                    if(in_array('updateCustomer', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCustomer" <?php if($serialize_permission) {
                                    if(in_array('deleteCustomer', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>Products</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleProduct" <?php if($serialize_permission) {
                                    if(in_array('moduleProduct', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProduct" <?php if($serialize_permission) {
                                    if(in_array('viewProduct', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProduct" <?php if($serialize_permission) {
                                    if(in_array('createProduct', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProduct" <?php if($serialize_permission) {
                                    if(in_array('updateProduct', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProduct" <?php if($serialize_permission) {
                                    if(in_array('deleteProduct', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr>

                              <tr>
                                 <td>Masters</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleMaster" <?php if($serialize_permission) {
                                    if(in_array('moduleMaster', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewMaster" <?php if($serialize_permission) {
                                    if(in_array('viewMaster', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createMaster" <?php if($serialize_permission) {
                                    if(in_array('createMaster', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateMaster" <?php if($serialize_permission) {
                                    if(in_array('updateMaster', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteMaster" <?php if($serialize_permission) {
                                    if(in_array('deleteMaster', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr>



                              <tr>
                                 <td>Products Type</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleProductType" <?php if($serialize_permission) {
                                    if(in_array('moduleProductType', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProductType" <?php if($serialize_permission) {
                                    if(in_array('viewProductType', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProductType" <?php if($serialize_permission) {
                                    if(in_array('createProductType', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProductType" <?php if($serialize_permission) {
                                    if(in_array('updateProductType', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProductType" <?php if($serialize_permission) {
                                    if(in_array('deleteProductType', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr>


                              <!-- <tr>
                                 <td>Department</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleDepartment" <?php if($serialize_permission) {
                                    if(in_array('moduleDepartment', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDepartment" <?php if($serialize_permission) {
                                    if(in_array('viewDepartment', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDepartment" <?php if($serialize_permission) {
                                    if(in_array('createDepartment', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDepartment" <?php if($serialize_permission) {
                                    if(in_array('updateDepartment', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDepartment" <?php if($serialize_permission) {
                                    if(in_array('deleteDepartment', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr> -->


                              <tr>
                                 <td>Company</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleCompany" <?php if($serialize_permission) {
                                    if(in_array('moduleCompany', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCompany" <?php if($serialize_permission) {
                                    if(in_array('viewCompany', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCompany" <?php if($serialize_permission) {
                                    if(in_array('createCompany', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCompany" <?php if($serialize_permission) {
                                    if(in_array('updateCompany', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCompany" <?php if($serialize_permission) {
                                    if(in_array('deleteCompany', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>Inquiry</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleInquiry" <?php if($serialize_permission) {
                                    if(in_array('moduleInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                  <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInquiry" <?php if($serialize_permission) {
                                    if(in_array('viewInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInquiry" <?php if($serialize_permission) {
                                    if(in_array('createInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInquiry" <?php if($serialize_permission) {
                                    if(in_array('updateInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInquiry" <?php if($serialize_permission) {
                                    if(in_array('deleteInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="assigntoInquiry" <?php if($serialize_permission) {
                                    if(in_array('assigntoInquiry', $serialize_permission)) { echo "checked"; } 
                                    } ?>></td>
                              </tr>
                        
                              <tr>
                                 <td>Members</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleUser" <?php 
                                    if($serialize_permission) {
                                      if(in_array('moduleUser', $serialize_permission)) { echo "checked"; }   
                                    }
                                    ?>></td>
                                       <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewUser" <?php 
                                    if($serialize_permission) {
                                      if(in_array('viewUser', $serialize_permission)) { echo "checked"; }   
                                    }
                                    ?>></td>
                                 <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createUser" <?php if($serialize_permission) {
                                    if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                                    } ?> ></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateUser" <?php 
                                    if($serialize_permission) {
                                      if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                                    }
                                    ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteUser" <?php 
                                    if($serialize_permission) {
                                      if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>Permission</td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="moduleGroup" <?php 
                                    if($serialize_permission) {
                                      if(in_array('moduleGroup', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGroup" <?php 
                                    if($serialize_permission) {
                                      if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGroup" <?php 
                                    if($serialize_permission) {
                                      if(in_array('createGroup', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGroup" <?php 
                                    if($serialize_permission) {
                                      if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGroup" <?php 
                                    if($serialize_permission) {
                                      if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }  
                                    }
                                     ?>></td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Update & Close</button>
                     <a href="<?php echo base_url('Controller_Permission/') ?>" class="btn btn-warning">Back</a>
                  </div>
               </form>
            </div>
            <!-- /.box -->
         </div>
         <!-- col-md-12 -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
   $(document).ready(function() {
     $("#mainGroupNav").addClass('active');
     $("#manageGroupNav").addClass('active');
   
   //   $('input[type="checkbox"].minimal').iCheck({
   //     checkboxClass: 'icheckbox_minimal-blue',
   //     radioClass   : 'iradio_minimal-blue'
   //   });
   });
   

   $('.selectall').click(function() {
      if ($(this).is(':checked')) {
         $('div input').attr('checked', true);
      } else {
         $('div input').attr('checked', false);
      }
   });
</script>