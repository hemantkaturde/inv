  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add New Customer
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer</li>
      </ol>
    </section>
<section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header">
  
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

         
            <form role="form" action="<?php base_url('Controller_Customer/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>
                <div class="row">
                <!-- <div class="col-md-6"> -->
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="customer">Customer <span class="required">*</span></label>
                      <input type="text" class="form-control" id="customer" name="customer" placeholder="Enter Customer Name" autocomplete="off" required="">
                    </div>

                    <div class="col-md-4">
                      <label for="contact_person">Contact Person</label>
                      <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter Contact Person" autocomplete="off">
                    </div>

                    <div class="col-md-4">
                      <label for="phone">Contact number</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Contact Number" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="mobile">Mobile No. <span class="required">*</span></label>
                      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" autocomplete="off" required="">
                    </div>
                    <div class="col-md-4">
                      <label for="email">Email <span class="required">*</span></label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" required="">
                    </div>
                    <div class="col-md-4">
                      <label for="email2">Email(Secondary)</label>
                      <input type="email2" class="form-control" id="email2" name="email2" placeholder="Email" autocomplete="off">
                    </div>
                    
                  </div>
                <!-- </div> -->
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="gst">GST</label>
                      <input type="text" class="form-control" id="gst" name="gst" placeholder="Enter GST No" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                      <label for="pan_no">PAN</label>
                      <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter PAN No" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                      <label for="address">Address <span class="required">*</span></label>
                      <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" autocomplete="off" required=""></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    
                    <div class="col-md-4">
                      <label for="del_address">Delhivery address</label>
                      <textarea type="text" class="form-control" id="del_address" name="del_address" placeholder="Enter Delhivery address" autocomplete="off"></textarea>
                    </div>
                    <div class="col-md-4">
                      <label for="notes">Notes</label>
                      <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes" autocomplete="off"></textarea>
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
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save & Close</button>
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
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->
    </section>

    </div>
<script type="text/javascript">
  $(document).ready(function() {
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
