 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Customer
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer</li>
      </ol>
    </section>
<section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
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

        
            
            <form role="form" action="<?php base_url('Controller_Members/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="row">
                  
                  <div class="form-group">
                    
                    <div class="col-md-4">
                      <label for="customer">Customer *</label>
                      <input type="text" class="form-control" id="customer" name="customer" value="<?php echo $customer_data['customer']['name'] ?>" placeholder="Enter customer name" autocomplete="off" required="">
                    </div>

                    <div class="col-md-4">
                      <label for="contact_person">Contact Person</label>
                      <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo $customer_data['customer']['contact_person'] ?>" placeholder="First name" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                      <label for="phone">Contact Number</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $customer_data['customer']['phone'] ?>" placeholder="Phone" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="mobile">Mobile No. *</label>
                      <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $customer_data['customer']['mobile'] ?>" placeholder="Phone" autocomplete="off" required="">
                    </div> 
                    <div class="col-md-4">
                      <label for="email">Email *</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer_data['customer']['email'] ?>" placeholder="Email" autocomplete="off" required="">
                    </div>
                    <div class="col-md-4">
                      <label for="email2">Email(Secondary)</label>
                      <input type="email2" class="form-control" id="email2" name="email2" value="<?php echo $customer_data['customer']['email_2'] ?>" placeholder="Email" autocomplete="off">
                    </div>                     
                  </div>
                <!-- </div> -->
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="gst">GST</label>
                      <input type="text" class="form-control" id="gst" name="gst" value="<?php echo $customer_data['customer']['gst_no'] ?>" placeholder="Enter GST No" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                      <label for="pan_no">PAN</label>
                      <input type="text" class="form-control" id="pan_no" name="pan_no" value="<?php echo $customer_data['customer']['pan_no'] ?>" placeholder="Enter PAN No" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                      <label for="address">Address *</label>
                      <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" autocomplete="off" value="<?php echo $customer_data['customer']['address'] ?>"><?php echo $customer_data['customer']['address'] ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="del_address">Delhivery address</label>
                      <textarea type="text" class="form-control" id="del_address" name="del_address" placeholder="Enter Delhivery address" autocomplete="off" value="<?php echo $customer_data['customer']['delivery_address'] ?>"><?php echo $customer_data['customer']['delivery_address'] ?></textarea>
                    </div>
                    <div class="col-md-4">
                      <label for="notes">Notes</label>
                      <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off" value="<?php echo $customer_data['customer']['notes'] ?>"><?php echo $customer_data['customer']['notes'] ?></textarea>
                    </div>
                    <!-- <div class="col-md-4">
                      <label for="cust_attach">Attachment</label>
                      <div class="kv-avatar">
                        <div class="file-loading">
                          <input id="cust_attach" name="cust_attach" type="file">
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <!-- ============= -->
                  <!-- <div class="form-group">
                    <div class="col-md-12">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $customer_data['cust_attachment'] ?>" width="100" height="100" class="">
                  </div>
                </div> -->

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url('Controller_Customer/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainCustomerNav").addClass('active');
    $("#manageCustomerNav").addClass('active');

    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#cust_attach").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>
