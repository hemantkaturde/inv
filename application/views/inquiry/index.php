
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>var $j = jQuery.noConflict(true);</script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>

      Manage Inquiry

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
            <?php echo $this->session->flashdata('error');  ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createInquiry', $user_permission) || ($_SESSION['id'] == 1)): ?>
          <a href="<?php echo base_url('Controller_Inquiry/create') ?>" class="btn btn-primary">Add Inquiry</a>
          <a href="" onClick="window.location.href=window.location.href" class="btn btn-warning">Refresh</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
         
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Inquiry No</th>
                <th>Customer Name</th>
                <th>Inquiry From</th>
                <th>Inquiry Date</th>
                <th>Status</th>
                <th>Assign To</th>
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

<?php if(in_array('deleteInquiry', $user_permission) || ($_SESSION['id'] == 1)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Inquiry</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Inquiry/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateInquiry', $user_permission) || in_array('deleteInquiry', $user_permission) || ($_SESSION['id'] == 1)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addInvoice">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Assign Inquiry</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Inquiry/add_invoice') ?>" method="post" id="addInvoiceForm">
        <div class="modal-body">
          <div class="row col-md-12">
            <div class="form-group">
              <label>Department <span class="text-danger">*</span></label>
              <select type="text" name="dept_id" id="dept_id" class="form-control"  required onchange="get_userListdata()">
                <option value="">Please Select</option>
                <?php if (!empty($department)) {
                  foreach ($department as $key => $value) { ?>
                    <option value="<?php echo $value['deprt_id'] ?>"><?php echo $value['department'] ?></option>
                <?php  }
                } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Member List <span class="text-danger">*</span></label>
              <select type="text" name="member_id" id="member_id" required class="form-control">
                <option value="">Please Select</option>
                <!-- <?php if (!empty($users)) {
                  foreach ($users as $key => $value) { ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['firstname'].' '.$value['lastname'] ?></option>
                <?php  }
                } ?> -->
              </select>
            </div>

            <!-- <div class="form-group">
              <label>Invoice Number</label>
              <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice Number">
            </div> -->
<!-- 
             <div class="form-group">
              <label>Invoice Date</label>
              <input type="text" name="invoice_date" id="invoice_date" class="form-control datepicker" placeholder="Enter Invoice Date">
            </div> -->

            <!-- <div class="form-group">
              <label>Vehicle Number</label>
              <input type="text" name="veh_no" id="veh_no" class="form-control" placeholder="Enter Vehicle Number">
            </div> -->

            <!-- <div class="form-group">
              <label>LR Number</label>
              <input type="text" name="inv_lr_no" id="inv_lr_no" class="form-control" placeholder="Enter LR Number">
            </div> -->

            <div class="form-group">
              <label>Remark</label>
              <textarea type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$j(document).ready(function() {
  
  $j("#mainInquiryNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ], 
    'ajax': base_url + 'Controller_Inquiry/fetchInquiryData',
    'order': []
  });

});

// remove functions 
function removeFunc(id)
{
  if(id) {
    $j("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $j(".text-danger").remove();

      $j.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { inquiry_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

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

// add invoice
// remove functions 
function addInvoiceFunc(id)
{
  if(id) {
    $j("#addInvoiceForm").on('submit', function() {

      var form = $(this);

      // console.log(form.attr('action')+'/'+id);

      // remove the text-danger
      $(".loader_ajax").show();

      $j(".text-primary").remove();

      $j.ajax({
        url: form.attr('action')+'/'+id,
        type: form.attr('method'),
        data: form.serialize(), 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $j("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

           

            $(form)[0].reset();
            // hide the modal
            $("#addInvoice").modal('hide');
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
// ==================
$(document).ready(function() {
    $('.datepicker').datepicker({
      autoclose: true
    })
});

function get_userListdata()
{
    var dept_id = $('#dept_id').val();
    var path = base_url+'controller_Inquiry/get_userListdata/'+dept_id;
    console.log(path);
    $.ajax({
        type : 'POST',
        url : path,
        dataType : 'json',
        success : function(response)
        {
            var data = "";
            data += '<select class="form-control" name="member_id" id="member_id" onchange="get_product_price()">';
            data += '<option value="">Please Select</option>';
                $.each(response, function(index, value){
                    data += '<option value="'+value['id']+'">'+value['firstname']+' '+value['lastname']+'</option>';
                });

            data += '</select>';

            $('#member_id').html(data);
        },
        error : function(response)
        {
            console.log(response);
        }

    });
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


<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').remove();
    }, 3000);
  })
</script>