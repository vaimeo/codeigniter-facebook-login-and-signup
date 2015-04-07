<?php

 function get_client_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 



 function insert_agent_logs($AgentId="",$AgentName="",$Action="") {


		$ci = get_instance();
      
 		$LogsData= array(
 				'IPAddress'=>get_client_ip(),
				 'Description'=>$ci->agent->agent_string(),
				'URL'=>$_SERVER['REQUEST_URI'],
				'DateTime'=>date('Y-m-d h:m:s'),
				'UserId'=>$AgentId,
				'UserName'=>$AgentName,
				'UserType'=>'2',
				'Action'=>$Action);
		$ci->db->insert('it_logs',$LogsData);

 } 



 function insert_admin_logs($AdminId="",$AdminName="",$Action="",$Description="",$Reference="") {


		$ci = get_instance();
      
 		
 		$LogsData= array(
 				'IPAddress'=>get_client_ip(),
				 'Description'=>$Description.'  '.$ci->agent->agent_string(),
				'URL'=>$_SERVER['REQUEST_URI'],
				'DateTime'=>date('Y-m-d h:m:s'),
				'UserId'=>$AdminId,
				'UserName'=>$AdminName,
				'UserType'=>'1',
				'Action'=>$Action);
		$ci->db->insert('it_logs',$LogsData);

 } 



?>