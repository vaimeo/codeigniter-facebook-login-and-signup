# codeigniter-facebook-login-and-signup
webisite facebook login and register user with facebook Oauth
#facebook library version '3.2.3' include
#Databse MySql 

<code>CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(10) DEFAULT NULL,
  `oauth_uid` text,
  `username` text,
  `password` text,
  `full_name` varchar(255) DEFAULT NULL,
  `picture` text,
  `other_info` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
</code>
<a href="http://www.vaimeo.com/demo/codeIgniter-facebook-login-and-register">Demo</a>


