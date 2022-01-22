<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css')?>">
    <style type="text/css">
    .flex-container {}

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        /*height: 200px;*/
        margin-top: 40px;
        /*border: 3px solid green; */
    }

    @media only screen and (max-width: 999px) {
        .d-none {
            display: none;
        }
    }

    @media only screen and (min-width: 999px) {
        .flex {
            display: flex;
        }
    }
    </style>

</head>
<!-- <body class="hold-transition login-page" style="background-image: url('assets/dist/img/inventory.jpg'); "> -->
<body style=" background-image: url('<?php echo base_url()."assets/dist/img/auth-bg.jpg" ?>'); background-size: cover;">
    <div class="container_fluid">
        <div class="row ">
            <div class="col-md-12 center">
                <!-- <div class="row center flex-container "> -->
                <div class="col-xs-8" style="background: #fff; margin-top:85px">
                    <div class="row flex">
                        <div class="col-md-6 col-md-12" style="padding:20px; align-self: center;">
                            <div style="margin-bottom: 40px;">
                                <h1
                                    style="padding: 20px; text-align: center; padding: 20px;font-weight: bolder;color: cornflowerblue;">
                                    Inventory</h1>
                            </div>
                            <?php if(!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <?php print_r($error); ?>
                            </div>
                            <?php endif; ?>
                            <form action="<?php echo base_url('auth/login') ?>" method="post">
                                <div class="form-group has-feedback">
                                    <select class="form-control" id="company" name="company"> 
                                        <option value="">Select Company</option>
                                        <?php foreach ($company_data as $k => $v): ?>
                                        <option value="<?php echo $v['id'] ?>"><?php echo $v['company_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
                                </div>

                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username" autocomplete="off">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="password" id="password"
                                        placeholder="Password" autocomplete="off">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign
                                            In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 d-none" style="background-color: #eee">
                            <img src="<?php echo base_url()."assets/dist/img/lock-screen.png"; ?>"
                                style="padding: 20px; width: -webkit-fill-available">
                        </div>

                    </div>
                </div>
                <!-- </div> -->
            </div>
            <!-- <div class="col-md-6">
      <img src="<?php echo base_url()."assets/dist/img/login_graphic.jpg"; ?>" style="width:webkit-fill-available">
    </div> -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    </script>
</body>

</html>