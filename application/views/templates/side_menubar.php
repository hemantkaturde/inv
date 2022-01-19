<?php
  $user_id = $this->session->userdata('id');
  $is_admin = ($user_id == 1) ? true :false;
?>
<aside class="main-sidebar">
    <?php if($is_admin){ ?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview" id="mainCustomerNav">
            <a href="#">
              <i class="fa fa-bank"></i>
              <span>Customer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createCustomerNav"><a href="<?php echo base_url('Controller_Customer/create') ?>"><i class="fa fa-circle-o"></i> Add Customer</a></li>
              <li id="manageCustomerNav"><a href="<?php echo base_url('Controller_Customer') ?>"><i class="fa fa-circle-o"></i> Manage Customer</a></li>
            </ul>
        </li>

        <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li id="addProductTypeNav"><a href="<?php echo base_url('Controller_Products/create_ptype') ?>"><i class="fa fa-circle-o"></i> Add Product Type</a></li>
                  <li id="manageProductTypeNav"><a href="<?php echo base_url('Controller_Products/product_type') ?>"><i class="fa fa-circle-o"></i> Manage Product Type</a></li>
                  <li id="addProductNav"><a href="<?php echo base_url('Controller_Products/create') ?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
                  <li id="manageProductNav"><a href="<?php echo base_url('Controller_Products') ?>"><i class="fa fa-circle-o"></i> Manage Products</a></li>
              </ul>
        </li>
        
        <li class="treeview" id="mainCompanyNav">
            <a href="#">
              <i class="fa fa-bank"></i>
              <span>Company</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createCompanyNav"><a href="<?php echo base_url('Controller_Company/create') ?>"><i class="fa fa-circle-o"></i> Add Company</a></li>
              <li id="manageCompanyNav"><a href="<?php echo base_url('Controller_Company') ?>"><i class="fa fa-circle-o"></i> Manage Company</a></li>
           
            </ul>
        </li>
         

        <li class="treeview" id="mainInquiryNav">
              <a href="#">
                <i class="fa fa-info-circle"></i>
                <span>Inquiry</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="addInquiryNav"><a href="<?php echo base_url('Controller_Inquiry/create') ?>"><i class="fa fa-circle-o"></i> Add Inquiry</a></li>
                <li id="manageInquiryNav"><a href="<?php echo base_url('Controller_Inquiry') ?>"><i class="fa fa-circle-o"></i> Manage Inquiry</a></li>
              </ul>
        </li>
         
    
        <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Members</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createUserNav"><a href="<?php echo base_url('Controller_Members/create') ?>"><i class="fa fa-circle-o"></i> Add Members</a></li>
              <li id="manageUserNav"><a href="<?php echo base_url('Controller_Members') ?>"><i class="fa fa-circle-o"></i> Manage Members</a></li>
            </ul>
        </li>

        <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-recycle"></i>
                <span>Permission</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="addGroupNav"><a href="<?php echo base_url('Controller_Permission/create') ?>"><i class="fa fa-circle-o"></i> Add Permission</a></li>
                <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Permission') ?>"><i class="fa fa-circle-o"></i> Manage Permission</a></li>
              </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
    <?php }else{ ?>

      <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview" id="mainCustomerNav">
            <a href="#">
              <i class="fa fa-bank"></i>
              <span>Customer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createCustomerNav"><a href="<?php echo base_url('Controller_Customer/create') ?>"><i class="fa fa-circle-o"></i> Add Customer</a></li>
              <li id="manageCustomerNav"><a href="<?php echo base_url('Controller_Customer') ?>"><i class="fa fa-circle-o"></i> Manage Customer</a></li>
            </ul>
        </li>

        <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li id="addProductNav"><a href="<?php echo base_url('Controller_Products/create') ?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
                  <li id="manageProductNav"><a href="<?php echo base_url('Controller_Products') ?>"><i class="fa fa-circle-o"></i> Manage Products</a></li>
              </ul>
        </li>
        
        <li class="treeview" id="mainCompanyNav">
            <a href="#">
              <i class="fa fa-bank"></i>
              <span>Company</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createCompanyNav"><a href="<?php echo base_url('Controller_Company/create') ?>"><i class="fa fa-circle-o"></i> Add Company</a></li>
              <li id="manageCompanyNav"><a href="<?php echo base_url('Controller_Company') ?>"><i class="fa fa-circle-o"></i> Manage Company</a></li>
           
            </ul>
        </li>
         

        <li class="treeview" id="mainInquiryNav">
              <a href="#">
                <i class="fa fa-info-circle"></i>
                <span>Inquiry</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="addInquiryNav"><a href="<?php echo base_url('Controller_Inquiry/create') ?>"><i class="fa fa-circle-o"></i> Add Inquiry</a></li>
                <li id="manageInquiryNav"><a href="<?php echo base_url('Controller_Inquiry') ?>"><i class="fa fa-circle-o"></i> Manage Inquiry</a></li>
              </ul>
        </li>
         
    
        <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Members</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="createUserNav"><a href="<?php echo base_url('Controller_Members/create') ?>"><i class="fa fa-circle-o"></i> Add Members</a></li>
              <li id="manageUserNav"><a href="<?php echo base_url('Controller_Members') ?>"><i class="fa fa-circle-o"></i> Manage Members</a></li>
            </ul>
        </li>

        <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-recycle"></i>
                <span>Permission</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="addGroupNav"><a href="<?php echo base_url('Controller_Permission/create') ?>"><i class="fa fa-circle-o"></i> Add Permission</a></li>
                <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Permission') ?>"><i class="fa fa-circle-o"></i> Manage Permission</a></li>
              </ul>
        </li>
      </ul>
    </section>
    <?php  } ?>
  </aside>