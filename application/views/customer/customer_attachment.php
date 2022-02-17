<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Customer Attachments
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customer Attachments</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-8 col-xs-12">

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
          <!-- <a href="<?php echo base_url('Controller_Customer/create') ?>" class="btn btn-primary">Add Attachment</a> -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_attachment" onclick="addAttach_Func(<?php echo $id; ?>)">Add Attachment</button>
          <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $id; ?>">
          <br /> <br />
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <!-- <th></th> -->
                <!-- <th>Image</th> -->
                <th>Attachment Name</th>
                <th>Document</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
              </thead>

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


<?php //if(in_array('addattachmentCustomer', $user_permission) || ($_SESSION['id'] == 1)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="add_attachment">
<div class="loader_ajax" style="display:none;">
	    <div class="loader_ajax_inner"><img src="<?php echo base_url(); ?>assets/images/preloader_ajax.gif"></div>
	  </div>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Attachment</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Customer/add_attachment') ?>" method="post" id="addAttachForm">
        <div class="modal-body">
          <div class="row" style="padding: 20px;">
            <div class="form-group">
              <label for="attach_name">File name <span class="required">*</span></label>
              <input type="text" class="form-control" id="attach_name" name="attach_name" placeholder="Enter File Name" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label for="attach_img">Attachment <span class="required">*</span></label>
              <input type="file" class="form-control" id="attach_img" name="attach_img" placeholder="Enter File Name" autocomplete="off" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"  onclick="clearform()" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Upload</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php //endif; ?>

<?php //if(in_array('deleteCustomer', $user_permission) || ($_SESSION['id'] == 1)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeTransModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Attachment</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Customer/removeTrans') ?>" method="post" id="removeTransForm">
        <div class="modal-body">
          <p>Do you really want to remove ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php //endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {

  $j("#mainCustomerNav").addClass('active');
    cust_id = $("#cust_id").val();
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ], 
    'ajax': base_url + 'Controller_Customer/fetchCustomerAttachments/'+cust_id,
    'order': []
  });

});


// Trans insert functions 
function addAttach_Func(id)
{
  if(id) {
    $j("#addAttachForm").on('submit', function() {

      $(".loader_ajax").show();
      var form = $(this);

      var file_data = $('#attach_img').prop('files')[0];
      var name = $("#attach_name").val();

      var form_data = new FormData();
      form_data.append('attach_img', file_data);
      form_data.append('id', id);
      form_data.append('attach_name', name);
      // remove the text-danger
      $j(".text-danger").remove();

      $j.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#add_attachment").modal('hide');
            $('#addAttachForm')[0].reset();
            $(".loader_ajax").hide();

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

// remove transaction functions 
function removeTransFunc(id)
{
  if(id) {
    $j("#removeTransForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $j(".text-danger").remove();

      $j.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeTransModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

function clearform(){
  $('#addAttachForm')[0].reset();
}

</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>