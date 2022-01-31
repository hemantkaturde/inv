<?php
  $user_id = $this->session->userdata('id');
  $is_admin = ($user_id == 1) ? true :false;
  $permission = $this->session->userdata('permission');

  $pageUrl1 =$this->uri->segment(1);
  $pageUrl2 =$this->uri->segment(2);
  if($pageUrl2){
    $pageUrl = $pageUrl1.'/'.$pageUrl2;
  }else{
    $pageUrl = $pageUrl1;
  }
?>
<aside class="main-sidebar">
      <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php if(in_array('moduleDashboard', unserialize($permission['permission']))) {  ?>
         <li id="dashboardMainMenu" <?php if($pageUrl=="Controller_Customer"){echo 'active';}?>>
            <a href="<?php echo base_url('dashboard') ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
        <?php } ?> 
        <?php if(in_array('moduleCustomer', unserialize($permission['permission']))) {  ?>
          <li class="treeview <?php if($pageUrl=="Controller_Customer" || $pageUrl=="Controller_Customer/create" || $pageUrl=="Controller_Customer/edit" || $pageUrl=="Controller_Products/index" || $pageUrl=="Controller_Customer/attachment" || $pageUrl=="Controller_Products/update"  || $pageUrl=="Controller_Products/create"){echo 'active';}?>">
              <a href="#">
                <i class="fa fa fa-handshake-o"></i>
                <span>Customer</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createCustomer', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Customer/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Customer/create') ?>"><i class="fa fa-plus"></i> Add Customer</a></li>
                <?php } ?>
                <?php if(in_array('viewCustomer', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Customer" || $pageUrl=="Controller_Customer/edit" || $pageUrl=="Controller_Customer/attachment" || $pageUrl=="Controller_Products/index" || $pageUrl=="Controller_Products/update" || $pageUrl=="Controller_Products/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Customer') ?>"><i class="fa fa-pencil"></i> Manage Customer</a></li>
                <?php } ?>
              </ul>
          </li>
        <?php }?> 

        <?php if(in_array('moduleMaster', unserialize($permission['permission']))) {  ?>
        <li class="treeview <?php if($pageUrl=="Controller_Masters/department" || $pageUrl=="Controller_Masters/createdepartment" || $pageUrl=="Controller_Products/product_type" || $pageUrl=="Controller_Products" || $pageUrl=="Controller_Products/create_ptype" || $pageUrl=="Controller_Products/update_ptype" ||  $pageUrl=='Controller_Masters/department_edit'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-bars"></i>
                <span>Masters</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              
              <ul class="treeview-menu">
              <?php if(in_array('moduleDepartment', unserialize($permission['permission']))) {  ?>
                 <li class="treeview <?php if($pageUrl=="Controller_Masters/department" || $pageUrl=="Controller_Masters/createdepartment" || $pageUrl=='Controller_Masters/department_edit'){echo 'active';}?>">
                    <a href="#">
                      <i class="fa fa-address-card-o"></i>
                      <span>Department</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                    <li <?php if($pageUrl=="Controller_Masters/createdepartment"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Masters/createdepartment') ?>"><i class="fa fa-plus"></i> Add Department</a></li>
                    <li <?php if($pageUrl=="Controller_Masters/department" ||$pageUrl=='Controller_Masters/department_edit'){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Masters/department') ?>"><i class="fa fa-pencil"></i> Manage Department</a></li>
                    </ul>
                </li>

                <?php } ?>
                <?php if(in_array('moduleDepartment', unserialize($permission['permission']))) {  ?>
                <li class="treeview <?php if($pageUrl=="Controller_Products/product_type" || $pageUrl=="Controller_Products" || $pageUrl=="Controller_Products/create_ptype" || $pageUrl=="Controller_Products/update_ptype"){echo 'active';}?>">
                    <a href="#">
                      <i class="fa fa fa-cube"></i>
                      <span>Product Type</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                    <li <?php if($pageUrl=="Controller_Products/create_ptype"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Products/create_ptype') ?>"><i class="fa fa-plus"></i> Add Product Type</a></li>
                    <li <?php if($pageUrl=="Controller_Products/product_type" || $pageUrl=="Controller_Products/update_ptype" ){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Products/product_type') ?>"><i class="fa fa-pencil"></i> Manage Product Type</a></li>
                    </ul>
                </li>
                <?php } ?>
              </ul>
             
        </li>
      <?php }?>
        
        <!-- <?php if(in_array('moduleProduct', unserialize($permission['permission']))) {  ?>
          <li class="treeview <?php if($pageUrl=="Controller_Products/product_type" || $pageUrl=="Controller_Products" || $pageUrl=="Controller_Products/create" || $pageUrl=="Controller_Products/update" ){echo 'active';}?>">
                <a href="#">
                  <i class="fa fa-cube"></i>
                  <span>Products</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <?php if(in_array('moduleProductType', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Products/product_type"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Products/product_type') ?>"><i class="fa fa fa-file-text"></i> Product Type</a></li>
                <?php } ?>
                <?php if(in_array('createProduct', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Products/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Products/create') ?>"><i class="fa fa-plus"></i> Add Product</a></li>
                <?php } ?>
                <?php if(in_array('viewProduct', unserialize($permission['permission']))) {  ?> 
                <li <?php if($pageUrl=="Controller_Products" || $pageUrl=="Controller_Products/update"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Products') ?>"><i class="fa fa-pencil"></i> Manage Products</a></li>
                <?php }?>    
                </ul>
          </li>
        <?php }?>    -->

        <?php if(in_array('moduleCompany', unserialize($permission['permission']))) {  ?>
          <li class="treeview <?php if($pageUrl=="Controller_Company" || $pageUrl=="Controller_Company/create" || $pageUrl=="Controller_Company/update" || $pageUrl=="Controller_Company/attachment" ){echo 'active';}?>" >
              <a href="#">
                <i class="fa fa-building"></i>
                <span>Company</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              <?php if(in_array('createCompany', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Company/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Company/create') ?>"><i class="fa fa fa-plus"></i> Add Company</a></li>
              <?php } ?>
              <?php if(in_array('viewCompany', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Company" || $pageUrl=="Controller_Company/update" || $pageUrl=="Controller_Company/attachment"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Company') ?>"><i class="fa fa fa-pencil"></i> Manage Company</a></li>
              <?php }?>
              </ul>
          </li>
          <?php }?>   

          <?php if(in_array('moduleInquiry', unserialize($permission['permission']))) {  ?>
          <li class="treeview <?php if($pageUrl=="Controller_Inquiry" || $pageUrl=="Controller_Inquiry/create" || $pageUrl =="Controller_Inquiry/update" || $pageUrl=="Controller_Inquiry/add_notes" ){echo 'active';}?>">
                <a href="#">
                  <i class="fa fa-volume-control-phone"></i>
                  <span>Inquiry</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <?php if(in_array('createInquiry', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Inquiry/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Inquiry/create') ?>"><i class="fa fa fa-plus"></i> Add Inquiry</a></li>
                <?php } ?>
                <?php if(in_array('viewInquiry', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Inquiry" || $pageUrl=="Controller_Inquiry/add_notes" || $pageUrl =="Controller_Inquiry/update"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Inquiry') ?>"><i class="fa fa fa-pencil"></i> Manage Inquiry</a></li>
                  <?php } ?>
                </ul>
          </li>
          <?php }?>   

          <?php if(in_array('moduleUser', unserialize($permission['permission']))) {  ?>
          <li class="treeview  <?php if($pageUrl=="Controller_Members" || $pageUrl=="Controller_Members/create" || $pageUrl=="Controller_Members/edit"){echo 'active';}?>">
              <a href="#">
                <i class="fa fa fa-users"></i>
                <span>Members</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createUser', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Members/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Members/create') ?>"><i class="fa fa-plus"></i> Add Members</a></li>
                <?php } ?>
                <?php if(in_array('viewUser', unserialize($permission['permission']))) {  ?>
                <li <?php if($pageUrl=="Controller_Members" || $pageUrl=="Controller_Members/edit"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Members') ?>"><i class="fa fa-pencil"></i> Manage Members</a></li>
                <?php } ?>
              </ul>
          </li>
          <?php }?>   


          <?php if(in_array('moduleGroup', unserialize($permission['permission']))) {  ?>
          <li class="treeview <?php if($pageUrl=="Controller_Permission" || $pageUrl=="Controller_Permission/create" || $pageUrl=="Controller_Permission/edit"){echo 'active';}?>">
                <a href="#">
                  <i class="fa fa fa-cog"></i>
                  <span>Permission</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php if(in_array('createGroup', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Permission/create"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Permission/create') ?>"><i class="fa fa fa-plus"></i> Add Permission</a></li>
                  <?php } ?>
                  <?php if(in_array('viewGroup', unserialize($permission['permission']))) {  ?>
                  <li <?php if($pageUrl=="Controller_Permission" || $pageUrl=="Controller_Permission/edit"){echo 'class="active"';}?>><a href="<?php echo base_url('Controller_Permission') ?>"><i class="fa fa-pencil"></i> Manage Permission</a></li>
                  <?php } ?>
                </ul>
          </li>
          <?php }?>  
      </ul>
    </section>
  </aside>
  