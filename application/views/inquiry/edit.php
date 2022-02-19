

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Edit Inquiry

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


        <form role="form" action="<?php base_url('inquiry/update') ?>" method="post" enctype="multipart/form-data">
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
                    <label for="inq_no">Inquiry Number</label>
                    <input type="text" class="form-control" id="inq_no" name="inq_no" placeholder="Enter Inquiry Number" autocomplete="off" value="<?php echo $inquiry_data['inquiry_number'] ?>" />
                </div>
                <div class="form-group">
                    <label for="inq_from">Inquiry From</label>
                    <select type="text" class="form-control" id="inq_from" name="inq_from" autocomplete="off">
                      <option value="">PLEASE SELECT</option>
                      <option value="1" <?php if($inquiry_data['inquiry_from'] == 1){ echo "selected"; } ?>>Justdial</option>
                      <option value="2" <?php if($inquiry_data['inquiry_from'] == 2){ echo "selected"; } ?>>Direct</option>
                      <option value="3" <?php if($inquiry_data['inquiry_from'] == 3){ echo "selected"; } ?>>Indiamart</option>
                      <option value="4" <?php if($inquiry_data['inquiry_from'] == 4){ echo "selected"; } ?>>Tradeindia</option>
                      <option value="5" <?php if($inquiry_data['inquiry_from'] == 5){ echo "selected"; } ?>>Whatsapp</option>
                      <option value="6" <?php if($inquiry_data['inquiry_from'] == 6){ echo "selected"; } ?>>Telephone</option>
                      <option value="7" <?php if($inquiry_data['inquiry_from'] == 7){ echo "selected"; } ?>>Email</option>
                      <option value="8" <?php if($inquiry_data['inquiry_from'] == 8){ echo "selected"; } ?>>Website</option>
                      <option value="9" <?php if($inquiry_data['inquiry_from'] == 9){ echo "selected"; } ?>>Exhibition</option>
                      <option value="10" <?php if($inquiry_data['inquiry_from'] == 10){ echo "selected"; } ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="customer">Customer</label>
                    
                  <select class="form-control" id="customer" name="customer" onchange="get_productList_customerwise()" >
                      <option value="">Select customer</option>
                      <?php foreach ($cust['customer'] as $key => $value): ?>
                        <option value="<?php echo $value['id']; ?>" <?php if($inquiry_data['customer_id'] == $value['id']) { echo 'selected'; } ?>><?php echo $value['name']; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="inq_date">Inquiry Date *</label>
                    <input type="text" class="form-control datepicker" id="inq_date" name="inq_date" placeholder="Enter Inquiry Date" value="<?php echo date('d-m-Y', strtotime($inquiry_data['inquiry_date'])) ?>" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select type="text" class="form-control" id="status" name="status" autocomplete="off">
                      <option value="">PLEASE SELECT</option>
                      <option value="4" <?php if($inquiry_data['inquiry_status'] == 4){ echo "selected"; } ?>>Create</option>
                      <option value="1" <?php if($inquiry_data['inquiry_status'] == 1){ echo "selected"; } ?>>Assigned</option>
                      <option value="2" <?php if($inquiry_data['inquiry_status'] == 2){ echo "selected"; } ?>>In Progress</option>
                      <option value="3" <?php if($inquiry_data['inquiry_status'] == 3){ echo "selected"; } ?>>Closed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="po_number">PO Number</label>
                    <input type="text" class="form-control" id="notes" name="po_number" value="<?php echo $inquiry_data['po_number'] ?>" placeholder="PO Number" autocomplete="off"></input>
                </div>

                <div class="form-group">
                    <label for="po_date">PO Date</label>
                    <input type="text" class="form-control datepicker" id="po_date" name="po_date" value="<?php echo date('d-m-Y', strtotime($inquiry_data['po_date'])) ?>" placeholder="PO Date" autocomplete="off" ></input>
                </div>

                <div class="form-group">
                    <label for="sales_order_number">Sales Order Number</label>
                    <input type="text" class="form-control" id="sales_order_number" name="sales_order_number" value="<?php echo $inquiry_data['sales_order_number'] ?>" placeholder="Sales Order Number" autocomplete="off"></input>
                </div>

                <?php if($inquiry_data['sales_order_date']==NULL){
                    // $sales_order = $inquiry_data['sales_order_date'];
                     $sales_order = "";
                }else{
                     $sales_order =date('d-m-Y', strtotime($inquiry_data['sales_order_date']));
                } ?>

                <div class="form-group">
                    <label for="sales_order_date">Sales Order Date</label>
                    <input type="text" class="form-control datepicker" id="sales_order_date" name="sales_order_date" value="<?php echo $sales_order; ?>" placeholder="Sales Order Date" autocomplete="off" ></input>
                </div>

                <?php if($inquiry_data['delivery_date']==NULL){
                    // $sales_order = $inquiry_data['sales_order_date'];
                     $delivery_date = "";
                }else{
                     $delivery_date =date('d-m-Y', strtotime($inquiry_data['delivery_date']));
                } ?>

                <div class="form-group">
                    <label for="delivery_date">Delivery Date</label>
                    <input type="text" class="form-control datepicker" id="delivery_date" name="delivery_date" value="<?php echo $delivery_date; ?>" placeholder="Delivery Date" autocomplete="off" ></input>
                </div>

                <div class="form-group">
                    <label for="delivery_date">Sales Order Done by</label>
                    <select class="form-control" id="sales_order_done_by" name="sales_order_done_by">
                      <option value="">Select Users</option>
                      <?php foreach ($user_list as $keyuser => $valueusrer): ?>
                        <option value="<?php echo $valueusrer['userid']; ?>" <?php if($inquiry_data['sales_order_by'] == $valueusrer['userid']) { echo 'selected'; } ?>><?php echo $valueusrer['firstname'].' '.$valueusrer['firstname'].' - '.'<b>'.$valueusrer['department'].'</b>'; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                    <label for="freight_charges">Freight charges</label>
                    <input type="text" class="form-control" id="freight_charges" name="freight_charges"  value="<?php echo $inquiry_data['freight_charges'] ?>" placeholder="Freight charges" autocomplete="off" ></input>
                </div>
                
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off"><?php echo $inquiry_data['inquiry_notes'] ?></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                  <a href="<?php echo base_url('Controller_Inquiry/index') ?>" class="btn btn-warning">Back</a>
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
                       <?php foreach ($product as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                      <?php endforeach ?>
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
                        <?php $inq_cnt = 1; if(!empty($trans_data)){ 
                          foreach($trans_data as $key => $value){
                        ?>
                          <tr id="inq_row_<?php echo $inq_cnt ?>">
                            <td>
                              <?php echo $value['name'] ?>
                              <input type="hidden" value="<?php echo $value['trans_id'] ?>" name="inq_trans_id[]" id="inq_trans_id_<?php echo $inq_cnt ?>">
                              <input type="hidden" value="<?php echo $value['product_id'] ?>" name="inq_product_id[]" id="inq_product_id_<?php echo $inq_cnt ?>">
                            </td>
                            <td>
                              <?php echo $value['rate'] ?>
                              <input type="hidden" value="<?php echo $value['rate'] ?>" name="inq_rate[]" id="inq_rate_<?php echo $inq_cnt ?>">
                            </td>
                            <td>
                              <?php echo $value['qty'] ?>
                              <input type="hidden" value="<?php echo $value['qty'] ?>" name="inq_qty[]" id="inq_qty_<?php echo $inq_cnt ?>">
                            </td>
                            <td>
                              <?php echo $value['final_amount'] ?>
                              <input type="hidden" value="<?php echo $value['final_amount'] ?>" name="inq_final_amt[]" id="inq_final_amt_<?php echo $inq_cnt ?>">
                            </td>
                            <td><a onclick="remove_inq_row(<?php echo $inq_cnt ?>)"><i class="fa fa-trash"></i></a></td>
                          </tr>
                        <?php $inq_cnt++; } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
        </div>
      </div>

      <!-- ============================= -->
      </form>
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
    echo "<script>";
    echo "var inq_cnt = $inq_cnt";
    echo "</script>";
?>
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $(".select_group").select2();

    $("#mainInquiryNav").addClass('active');
    $("#manageInquiryNav").addClass('active');
    $('.datepicker').datepicker({
      autoclose: true
    })
  });
</script>
<script src="<?php echo base_url('assets/dist/js/pages/inquiry.js') ?>"></script>