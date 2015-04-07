<html>
<head>
    <title>Login and Signup with Facebook | Wajid Abid</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
</head>
<body>

    <div class="container">

        <form class="form-signin" role="form" method="post"  style="color:white;max-width:800px !important" action="<?php echo site_url('home/register');?>">
                <div class="row">
                    <div class="col-lg-12">
                         <div class="form-group col-sm-8">
                            <label>Your Account already exist please provide your email address to get link</label>
                            <input class="form-control" name="full_name"   type="text" value="">
                          </div>
                       
                         <div class="form-group col-sm-4">

                            <input class="btn btn-default" name="Submit" type="submit" value="Send Reset Link" style="margin-top:45px" >
                          </div>     
                    </div>
                </div>
        </form>
    </div> <!-- /container -->
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>