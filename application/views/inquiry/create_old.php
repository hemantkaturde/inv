
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Inquiry
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inquiry</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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
         
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('inquiry/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="inq_no">Inquiry Number</label>
                    <input type="text" class="form-control" id="inq_no" name="inq_no" placeholder="Enter Inquiry Number" autocomplete="off" value="<?php echo $inq_no; ?>" />
                  </div>

                  <div class="col-md-4">
                    <label for="customer">Customer</label>
                    
                    <select class="form-control" id="customer" name="customer">
                      <option value="">Select customer</option>
                      <?php foreach ($cust['customer'] as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label for="inq_from">Inquiry From</label>
                    <select type="text" class="form-control" id="inq_from" name="inq_from" autocomplete="off">
                      <option value="">Select Inquiry From</option>
                      <option value="1">Justdial</option>
                      <option value="2">Direct</option>
                      <option value="3">Indiamart</option>
                      <option value="4">Tradeindia</option>
                      <option value="5">Whatsapp</option>
                      <option value="6">Telephone</option>
                      <option value="7">Email</option>
                      <option value="8">Website</option>
                      <option value="9">Exhibition</option>
                      <option value="10">Other</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="inq_date">Inquiry Date *</label>
                    <input type="text" class="form-control" id="inq_date" name="inq_date" placeholder="Enter Inquiry Date" autocomplete="off"/>
                  </div>

                  <div class="col-md-4">
                    <label for="product">Product</label>
                    <select class="form-control" id="product" name="product[]" multiple="">
                      <option value="">Select product</option>
                      <?php foreach ($product as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label for="status">Status</label>
                    <select type="text" class="form-control" id="status" name="status" autocomplete="off">
                      <option value="">Select Status</option>
                      <option value="1">Assigned</option>
                      <option value="2">In Progress</option>
                      <option value="3">Closed</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="emp_assigned">Employee Assigned</label>
                    <input type="text" class="form-control" id="emp_assigned" name="emp_assigned" placeholder="Employee Assigned" autocomplete="off"/>
                  </div>

                  <div class="col-md-4">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off" /></textarea>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Controller_inquiry/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
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
    $(".select_group").select2();

    $("#mainInquiryNav").addClass('active');
    $("#addInquiryNav").addClass('active');
    
  });
</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>