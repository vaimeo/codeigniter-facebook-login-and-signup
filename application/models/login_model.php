<?php

class login_model extends CI_Model {

	public $tableName;

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function verify_login($oauth_uid,$oauth_username,$picture,$full_name,$oauth_provider){
    		$this->db->where('oauth_uid',$oauth_uid);
    		$this->db->where('oauth_provider',$oauth_provider);
    		$r = $this->db->get('users');

    		if($r->num_rows()==0){
    			//we are inserting data
    			$this->db->insert('users',array(
    						'oauth_uid'=>$oauth_uid,
    						'oauth_provider'=>$oauth_provider,
                            'picture'=>$picture,
                            'full_name'=>$full_name,
    						'username'=>$oauth_username
    					));
                $user_id=$this->db->insert_id();
                }else{
                    $row=$r->row();
                    $user_id=$row->id;
                }

                return $user_id;
    }


    

    function user_exist($email){
        $this->db->where('username',$email);
        $d=$this->db->get('users');
        if($d->num_rows()>0){
            return true;
        }else{
            return false;
        }
        
    }


    function get_user_info($user_id){
        $this->db->where('id',$user_id);
        $r=$this->db->get('users')->row();
        return $r;
    }

    //if we have user data in system we will just update other info otherwise we will insert new data
    function register($oauth_uid,$oauth_username,$picture,$full_name,$oauth_provider){
    		$this->db->where('oauth_uid',$oauth_uid);

                $this->db->insert('users',array(
                            'oauth_uid'     =>  $this->input->post('oauth_uid'),
                            'oauth_provider'=>  $this->input->post('oauth_provider'),
                            'username'      =>  $this->input->post('oauth_username'),
                            'picture'       =>  $this->input->post('picture'),
                            'password'      =>  $this->input->post('password'),
                            'full_name'     =>  $this->input->post('full_name')
                        ));
    }
}
 ?>