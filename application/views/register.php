<html>
<head>
    <title>Login and Signup with Facebook | Wajid Abid</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
</head>
<body>

    <div class="container">

        <form class="form-signin" role="form" method="post"  style="color:white" action="<?php echo site_url('home/register');?>">
            <?php if($user_profile){?>
                

                <div class="row">
                    <div class="col-lg-12">
                         <div class="form-group col-sm-12">
                            <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" style="width: 140px; height: 140px;">
                         </div>
                         <div class="form-group col-sm-12">
                            <label>Full Name</label>
                            <input class="form-control" name="full_name"  disabled type="text" value="<?=$user_profile['name']?>">
                          </div>
                         <div class="form-group col-sm-12">
                            <label>userName</label>
                            <input class="form-control" name="UserName"  disabled ype="text" value="<?=$user_profile['email']?>">
                          </div>                          
                         <div class="form-group col-sm-12">
                            <label>Password</label>
                            <input class="form-control" name="password" type="text" >
                          </div>                          
                         <div class="form-group col-sm-12">
                            <input class="btn btn-default" name="Submit" type="submit" value="Register" >
                          </div>     
<input class="form-control" name="oauth_uid"      type="hidden" value="<?php echo $user_profile['id']; ?>">
<input class="form-control" name="oauth_provider" type="hidden" value="facebook">
<input class="form-control" name="oauth_username" type="hidden" value="<?php echo $user_profile['email']; ?>">
<input class="form-control" name="picture"        type="hidden" value="https://graph.facebook.com/<?php echo $user_profile['id']; ?>/picture?type=large">
<input class="form-control" name="full_name"      type="hidden" value="<?php echo $user_profile['first_name']; ?>  <?php echo $user_profile['last_name']; ?>">                     
                    </div>
                </div>
                <?php } ?>
        </form>
    </div> <!-- /container -->
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>