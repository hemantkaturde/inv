

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


        <div class="box">
         
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('inquiry/update') ?>" method="post" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="inq_no" name="inq_no" placeholder="Enter product name" autocomplete="off" value="<?php echo $inquiry_data['inquiry_number'] ?>" />
                  </div>

                  <div class="col-md-4">
                    <label for="customer">Customer</label>
                    <select class="form-control" id="customer" name="customer">
                      <option value="">Select customer</option>
                    <?php foreach ($cust['customer'] as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($inquiry_data['customer_id'] == $v['id']) { echo 'selected'; } ?> ><?php echo $v['name'] ?></option> 
                    <?php endforeach ?>
                  </select>
                  </div>

                  <div class="col-md-4">
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
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="inq_date">Inquiry Date *</label>
                    <input type="text" class="form-control" id="inq_date" name="inq_date" placeholder="Enter product name" autocomplete="off" value="<?php echo date('d-m-Y', strtotime($inquiry_data['inquiry_date'])) ?>"/>
                  </div>

                  <div class="col-md-4">
                    <label for="product">Product</label>
                    <select type="text" class="form-control" id="product" name="product[]" multiple="" />
                    <option value="">Select product</option>
                    <?php foreach ($product as $k => $v): 
                      // print_r($inquiry_data['inquiry_product']);
                      $pro = explode(",", $inquiry_data['inquiry_product']);
                        foreach ($pro as $kp => $vp) {
                          if ($vp == $v['id']) {
                  
                            $selected = "selected";
                          }else
                          {
                            $selected = "";
                          }
                        }
                    ?>
                      <option value="<?php echo $v['id'] ?>" <?php echo $selected; ?> ><?php echo $v['name'] ?></option> 
                    <?php endforeach ?>
                  </select>
                  </div>

                  <div class="col-md-4">
                    <label for="status">Status</label>
                    <select type="text" class="form-control" id="status" name="status" autocomplete="off">
                      <option value="">PLEASE SELECT</option>
                      <option value="1" <?php if($inquiry_data['inquiry_status'] == 1){ echo "selected"; } ?>>Assigned</option>
                      <option value="2" <?php if($inquiry_data['inquiry_status'] == 2){ echo "selected"; } ?>>In Progress</option>
                      <option value="3" <?php if($inquiry_data['inquiry_status'] == 3){ echo "selected"; } ?>>Closed</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="emp_assigned">Employee Assigned</label>
                    <input type="text" class="form-control" id="emp_assigned" name="emp_assigned" placeholder="Enter Employee Assigned" autocomplete="off" value="<?php echo $inquiry_data['inquiry_emp_assigned'] ?>"/>
                  </div>

                  <div class="col-md-4">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off"  value="<?php echo $inquiry_data['inquiry_notes'] ?>"/><?php echo $inquiry_data['inquiry_notes'] ?></textarea>
                  </div>
                </div>

              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Controller_Inquiry/') ?>" class="btn btn-warning">Back</a>
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
    $("#manageInquiryNav").addClass('active');
  
  });
</script>