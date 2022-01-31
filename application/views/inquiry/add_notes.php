
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Inquiry Notes 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inquiry</li>
      <li class="active">Add Inquiry Notes </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-8 col-xs-8">
        <div id="messages"></div>
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error');  ?>
          </div>
        <?php endif; ?>


        <form role="form" action="<?php base_url('Controller_Inquiry/create') ?>" method="post" enctype="multipart/form-data">
                  <div class="col-md-4">
                    <label for="company_email1">Inquiry Number</label>
                    <input type="text" class="form-control" id="Inquiry_number"  value="<?php echo $getInquiryDetails[0]['inquiry_number'];?>" name="Inquiry_number" readonly>
                  </div>
                  <div class="col-md-4">
                    <label for="company_email2">Date</label>
                    <input type="text" class="form-control datepicker" id="date" name="date" placeholder="Enter date" autocomplete="off">
                  </div>
                  <div class="col-md-4">
                    <label for="notes">Notes</label>
                    <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Enter Notes"  autocomplete="off"></textarea>
                  </div>
            
                  <div style="margin-left:14px">
                  <button type="submit" class="btn btn-primary">Save & Close</button>
                  </div>
                   
                 <br /> <br />

        </form>
    
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date</th>
                <th>Notes</th>
                <th>Action</th>
              </tr>
              </thead>
              <?php if($notes_data): ?>                  
                    <?php foreach ($notes_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['notes_data']['notes']; ?></td>
                        <td> 

                        </td>
                    </tr>  
                    <?php endforeach; ?>
              <?php endif; ?>
            </table>
          </div>
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

var manageTable;
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {

  $j("#mainCompanyNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ], 
    //'ajax': base_url + 'Controller_Inquiry/fetchNotesData',
    'order': []
  });

});

$(document).ready(function() {
    $('.datepicker').datepicker({
      autoclose: true
    })
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