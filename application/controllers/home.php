<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct(){
		parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
        $this->load->model('login_model');

	}

    public function index(){
    $user_id=$this->session->userdata('user_id');

            if(!$user_id){

                       $this->load->library('facebook'); // Automatically picks appId and secret from config
                    $user = $this->facebook->getUser();
                    if ($user) {
                        try {
                            $data['user_profile'] = $this->facebook->api('/me');

                           $user_id=$this->login_model->verify_login($data['user_profile']['id'],$data['user_profile']['email'],'https://graph.facebook.com/'.$data['user_profile']['id'].'/picture?type=large',$data['user_profile']['first_name'].' '.$data['user_profile']['last_name'],'facebook');
                                            $this->session->set_userdata(array('userid'=>$user_id));
                        } catch (FacebookApiException $e) {
                            $user = null;
                        }
                    }else {
                        $this->facebook->destroySession();
                    }

            }
    

        if($user_id){
            $data['user_data']=$this->login_model->get_user_info($user_id);
            $this->load->view('home',$data);
        }else{
            redirect('home/login');
        }

    }

	public function login(){

        $this->claear_session();

            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('home/index'), 
                'scope' => array("email") // permissions here
            ));
             $data['register_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('home/signup'), 
                'scope' => array("email") // permissions here
            ));
        $this->load->view('login',$data);


	}



    public function signup(){


        $this->claear_session();
        $this->load->library('facebook'); // Automatically picks appId and secret from config
      
        $user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
            redirect('home/login');
        }

        $this->load->view('register',$data);



    }



    public function register(){
        if($this->login_model->user_exist($this->input->post('oauth_username'))){
           $this->load->view('forgot');
        }
        else{

           if($this->input->post('Submit')){
                    $this->login_model->register();
                }

        }
    }


    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();

 $this->session->sess_destroy();
       
        redirect('home/login');
    }



    private function claear_session(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

 $this->session->sess_destroy();

    }

}

