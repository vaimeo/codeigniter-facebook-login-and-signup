<html>
<head>
    <title>Login and Signup with Facebook | Wajid Abid</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
</head>
<body>

    <div class="container" style="color:white">
            <?php if($user_data){?>
                   <h2 class="form-signin-heading">Wellcom  <?php echo $user_data->full_name?></h2>
         
                <div class="row">
                    <div class="col-lg-3 text-center">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="<?php echo $user_data->picture; ?>" style="width: 140px; height: 140px;">
                        <h2><?php echo $user_data->full_name?></h2>
                        <a href="<?php echo site_url('home/logout');?>" class="btn btn-sm btn-primary btn-block" role="button">Logout</a>
                     
                    </div>
                    <div class="col-lg-6" style="color:white">
                    <h3>Result</h3>
                       <pre>
                        <?php print_r($user_data);?>
                        </pre>
                    </div>
                </div>
                <?php } ?>
    </div> <!-- /container -->
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>