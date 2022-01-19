<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Edit Products

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
          <form role="form" action="<?php base_url('product/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-circle">
                </div>

                <div class="form-group">  
                  <div class="col-md-3">
                    <label for="product_name">Product name *</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo $product_data['name']; ?>"  autocomplete="off" required/>
                  </div>

                  <div class="col-md-3">
                    <label for="product_code">Product Code *</label>
                    <!-- <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code" value="<?php echo $product_data['product_code']; ?>" autocomplete="off" required/> -->
                    <select class="form-control" id="product_code" name="product_code">
                      <option value="">Select</option>
                      <?php foreach ($type as $key => $value): ?>
                        <option value="<?php echo $value['type_id'] ?>" <?php if($product_data['product_code'] == $value['type_id']) { echo 'selected'; } ?>><?php echo $value['product_type'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Rate" value="<?php echo $product_data['price']; ?>" autocomplete="off" />
                  </div>

                  <div class="col-md-3">
                    <label for="product_image">Update Image</label>
                    <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6">
                    <label for="description">Description *</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                      <?php echo $product_data['description']; ?>
                    </textarea>
                  </div>

                  <div class="col-md-6">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter 
                  notes" autocomplete="off">
                      <?php echo $product_data['notes']; ?>
                    </textarea>
                  </div>
                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Controller_Products/') ?>" class="btn btn-warning">Back</a>
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
    $("#description").wysihtml5();
    $("#notes").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
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