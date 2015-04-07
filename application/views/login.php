<html>
<head>
    <title>Login and Signup with Facebook | Wajid Abid</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
</head>
<body>

    <div class="container">

        <form class="form-signin" role="form">
                <h2 class="form-signin-heading">Codeigniter Facebook</h2>
                <a href="<?= $login_url ?>" class="btn btn-sm btn-primary btn-block" role="button">Login with Facebook</a>
                <a href="<?= $register_url ?>" class="btn btn-sm btn-primary btn-block" role="button">Register With Facebook</a>
            <a href="https://github.com/puneetkay/Facebook-PHP-CodeIgniter" class="btn btn-sm btn-success btn-block" target="_blank" role="button">View Source on Github</a>

        </form>


    </div> <!-- /container -->
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>