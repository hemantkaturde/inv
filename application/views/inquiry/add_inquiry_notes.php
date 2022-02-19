
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add New Note
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="#">Inquiry</li>
      <li class="active">Add New Note</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <!-- <div id="messages"></div> -->

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


      
        <form role="form" action="<?php base_url('Controller_Inquiry/add_notes') ?>" method="post" enctype="multipart/form-data">
      <!-- ============================= -->
      <div class="col-md-6">
        <div class="box">
              <div class="box-body">
                <?php if (!empty(validation_errors())) { ?>
                
                <div class="alert alert-error alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php  } ?>

                <div class="form-group">
                    <label for="Inquiry_number">Inquiry Number <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" id="Inquiry_number" name="Inquiry_number" placeholder="Enter Inquiry Number" value="<?php echo $getInquiryDetails[0]['inquiry_number'];?>" readonly autocomplete="off" />
                </div>
         
                <div class="form-group">
                    <label for="date">Date</label>
                    <input required type="text" class="form-control datepicker" id="date" name="date" placeholder="Date" autocomplete="off" ></input>
                </div>

            
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea required type="text" class="form-control" id="inquiry_notes" name="inquiry_notes" placeholder="Enter Notes" autocomplete="off"></textarea>
                </div>
                <input required type="hidden" class="form-control" id="inquiry_id" name="inquiry_id" value="<?php echo $inquiry_id;?>" ></input>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                  <a href="<?php echo base_url('Controller_Inquiry/add_notes/'.$inquiry_id) ?>" class="btn btn-warning">Back</a>
                </div>
              </div>
          <!-- /.box-body -->
        </div>
      </div>
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
  var base_url = "<?php echo base_url(); ?>";
 
  $(document).ready(function() {
    $(".select_group").select2();


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