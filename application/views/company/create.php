  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Company
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">company</li>
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
            
            <form role="form" action="<?php base_url('company/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="company_name">Company <span class="required">*</span></label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="phone">Mobile No</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="tel_no">Tel No</label>
                  <input type="text" class="form-control" id="tel_no" name="tel_no" placeholder="Enter Telephone" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  
                  <div class="col-md-4">
                    <label for="company_email1">Email</label>
                    <input type="text" class="form-control" id="company_email1" name="company_email1" placeholder="Enter company Email" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="company_email2">Email2</label>
                    <input type="text" class="form-control" id="company_email2" name="company_email2" placeholder="Enter company Email" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="address">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter address"  autocomplete="off"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="pan_no">GST No</label>
                    <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Enter GST NO" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="pan_no">PAN No</label>
                    <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter PAN NO" autocomplete="off">
                  </div>
                  
                  <div class="col-md-4">
                    <label for="company_logo">Logo</label>
                    <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="company_logo" name="company_logo" type="file">
                      </div>
                    </div>
                  </div>
                </div>

                

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="factory_address">Factory address</label>
                    <textarea type="text" class="form-control" id="factory_address" name="factory_address" placeholder="Enter factory address" autocomplete="off"></textarea>
                  </div>
                  <div class="col-md-4">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes"autocomplete="off"></textarea>
                  </div>

                  <div class="col-md-1">
                    <label for="prefix">Prefix</label>
                    <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Prefix" autocomplete="off"/>
                  </div>

                  <div class="col-md-1">
                    <label for="count">Count</label>
                    <input type="text" class="form-control" id="count" name="count" placeholder="Count" autocomplete="off"/>
                  </div>

                  <div class="col-md-1">
                    <label for="sufix">Sufix</label>
                    <input type="text" class="form-control" id="sufix" name="sufix" placeholder="Sufix" autocomplete="off"/>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Controller_Company/') ?>" class="btn btn-warning">Back</a>
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
    $("#mainCompanyNav").addClass('active');
    $("#createCompanyNav").addClass('active');
    $("#message").wysihtml5();

    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#company_logo").fileinput({
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
