  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">INV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Inventory</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span style="margin-left: 10px; font-size: 20px;"><?php echo $_SESSION['company_name']; ?>
        <!-- <p style="margin-left: 10px; font-size: 10px;"><?php echo "Welcome, ".$_SESSION['username']; ?></p> -->
       </span>
      </a>
      <div class="navbar-custom-menu">
        <!-- <ul class="nav navbar-nav">
          <li class="dropdown user-menu" style="display: flex;">
            <a><?php echo "Welcome, ".$_SESSION['username']; ?></a> <a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> LOGOUT</a>
          </li>
        </ul> -->
        <ul class="nav navbar-nav">
          <li>
            <a><?php echo "Welcome, ".$_SESSION['username']; ?></a>
          </li>
          <li>
             <a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> LOGOUT</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').remove();
    }, 3000);
  })
</script>

<style type="text/css">
  .col-md-4,.col-md-1{
    margin-top: 15px;
  }
  .required{
    color:#ff0000;
  }
   .main-header .sidebar-toggle {
    padding: 8px 10px;
  }
  .required{
    color:#ff0000;
  }
 </style>