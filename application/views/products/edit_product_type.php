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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php elseif($this->session->flashdata('error')): ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php endif; ?>


                <div class="box">

                    <!-- /.box-header -->
                    <form role="form" action="<?php base_url('product/update_ptype') ?>" method="post">
                        <div class="box-body">

                            <?php if (!empty(validation_errors())) { ?>

                            <div class="alert alert-error alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php  } ?>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="product_type">Product Type <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="product_type" name="product_type"
                                        placeholder="Enter product Type"
                                        value="<?php echo $product_data['product_type']; ?>" autocomplete="off"
                                        required />
                                </div>


                            </div>



                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('Controller_Products/product_type') ?>"
                                class="btn btn-warning">Back</a>
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
    $("#mainProductNav").addClass('active');
    $("#manageProductTypeNav").addClass('active');

});
</script>