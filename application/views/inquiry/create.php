
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
        <!-- /.box -->
      </div>
      <form role="form" action="<?php base_url('inquiry/create') ?>" method="post" enctype="multipart/form-data">
      <!-- ============================= -->
      <div class="col-md-4">
        <div class="box">
              <div class="box-body">
                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="form-group">
                    <label for="inq_no">Inquiry Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inq_no" name="inq_no" placeholder="Enter Inquiry Number" autocomplete="off" value="<?php echo $inq_no; ?>" />
                </div>
                <div class="form-group">
                    <label for="inq_from">Inquiry From <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="inq_from" name="inq_from" autocomplete="off" required>
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
                <div class="form-group">
                  <label for="customer">Customer <span class="text-danger">*</span></label>
                    
                  <select class="form-control" id="customer" name="customer" onchange="get_productList_customerwise()" required>
                      <option value="">Select customer</option>
                      <?php foreach ($cust['customer'] as $key => $value): ?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="inq_date">Inquiry Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control datepicker" id="inq_date" name="inq_date" placeholder="Enter Inquiry Date" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="status" name="status" autocomplete="off" disabled required>
                      <option value="">Select Status</option>
                      <option value="4" selected>Create</option>
                      <option value="1">Assigned</option>
                      <option value="2">In Progress</option>
                      <option value="3">Closed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="po_number">PO Number</label>
                    <input type="text" class="form-control" id="notes" name="po_number" placeholder="PO Number" autocomplete="off"></input>
                </div>

                <div class="form-group">
                    <label for="po_date">PO Date</label>
                    <input type="text" class="form-control datepicker" id="po_date" name="po_date" placeholder="PO Date" autocomplete="off" ></input>
                </div>

                <div class="form-group">
                    <label for="freight_charges">Freight charges</label>
                    <input type="text" class="form-control" id="freight_charges" name="freight_charges" placeholder="Freight charges" autocomplete="off" ></input>
                </div>

                <!-- <div class="form-group">
                    <label for="reference_number">Reference Number</label>
                    <textarea type="text" class="form-control" id="reference_number" name="reference_number" placeholder="Reference Number" autocomplete="off" ></textarea>
                </div> -->
                
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off"></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                  <a href="<?php echo base_url('Controller_inquiry/') ?>" class="btn btn-warning">Back</a>
                </div>
              </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- ============================= -->

      <div class="col-md-8">
        <div class="box">
              <div class="box-body">
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="product">Product</label>
                    <select class="form-control" id="product" name="product" onchange="get_product_price()">
                      <option value="">Select product</option>
                       <!-- <?php foreach ($product as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                      <?php endforeach ?> -->
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Rate" onkeyup="calulate_amount()" autocomplete="off"/>
                  </div>
                  <div class="col-md-2">
                    <label for="qty">Quantity</label>
                    <input type="text" class="form-control" id="qty" name="qty" onkeyup="calulate_amount()" autocomplete="off" placeholder="Qty" />
                  </div>
                  <div class="col-md-3" style="margin-bottom:20px;">
                    <label for="final_amt">Total Amount</label>
                    <input type="text" class="form-control" id="final_amt" name="final_amt" placeholder="Final Amount" autocomplete="off" readonly/>
                  </div>

                  <div class="col-md-1">
                    <a onclick="add_inquiry_row()" class="btn btn-xs btn-success" style="margin-top:12px;"><i class="fa fa-plus" ></i></a>
                  </div>
                </div>

                <div class="">
                  <table class="table table-bordered table-responsive">
                    <thead class="bg-primary">
                      <tr>
                        <td>Product</td>
                        <td>Rate</td>
                        <td>Qty</td>
                        <td>Final Amt</td>
                        <td>Delete</td>
                      </tr>
                    </thead>
                    <tbody id="inquiry_wrapper">

                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
        </div>
      </div>

      <!-- ============================= -->
      </form>
      <!-- ============================= -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
 
  $(document).ready(function() {
    $(".select_group").select2();

    $("#mainInquiryNav").addClass('active');
    $("#addInquiryNav").addClass('active');
    
    // $('.datepicker').datepicker({
    //   autoclose: true,
    //   minDate:new Date()
    // })

var date = new Date();
date.setDate(date.getDate());

$('.datepicker').datepicker({ 
    startDate: date
});

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
<script src="<?php echo base_url('assets/dist/js/pages/inquiry.js') ?>"></script>