<?php

class general_model extends CI_Model {

 
	public $tableName;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }



    function get_field_value($table_name,$get_field_name,$key_field_name_array,$key_field_id_array)
    {

      
    
            $this->db->select($get_field_name);
            
            foreach ($key_field_id_array as $fid => $fval) {
                   $this->db->where($key_field_name_array[$fid],$fval);
                } 


            $query = $this->db->get($table_name);
            ///print_r($this->db->last_query());

            if($query->num_rows()>0)
            {
              $g=$query->result_array();
              $r=$g[0][$get_field_name];
            }
            else
            {
              $r='';
            }

            return $r;

    }



    function get_slides_data(){

        $this->db->where('MediaType','slide');
        $m  =   $this->db->get('it_media');
        return $m->result_array();

    }


}
 ?>