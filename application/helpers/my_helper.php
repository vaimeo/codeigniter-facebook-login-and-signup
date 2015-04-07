<?php 


function get_dd_value($tables){

  	$ci = get_instance();

	if(in_array('it_vendor',$tables))
	{
		$data['SelectedVendor']="";
		$ci->db->select('*');
		$ci->db->order_by('VendorName','asc');
 		$RoomCategoryList	= $ci->db->get('it_vendor')->result();
		$ListArray	=array();
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->VendorId]=$fieldvalue->VendorName;
        }
        $data['VendorList']=$ListArray;
	}
	
	if(in_array('it_category',$tables))
	{
		$data['SelectedCategory']="";
		$ci->db->select('*');
		$ci->db->order_by('CategoryName','asc');
 		$RoomCategoryList	= $ci->db->get('it_category')->result();
		$ListArray	=array();
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->CategoryId]=$fieldvalue->CategoryName;
        }
        $data['CategoryList']=$ListArray;
	}


	if(in_array('it_country',$tables))
	{
		$data['SelectedCountry']="";
		$ci->db->select('*');
		$ci->db->order_by('CountryName','asc');
 		$RoomCategoryList	= $ci->db->get('it_country')->result();
		$ListArray	=array();
		$ListArray[]="Select Country";
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->CountryId]=$fieldvalue->CountryName;
        }
        $data['CountryList']=$ListArray;
	}


	if(in_array('it_vendor_category',$tables))
	{
		$data['SelectedVendorCountry']="";
		$ci->db->select('*');
		$ci->db->order_by('VCategoryName','asc');
 		$RoomCategoryList	= $ci->db->get('it_vendor_category')->result();
		$ListArray	=array();
		$ListArray[]="Select Category";
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->VCategoryId]=$fieldvalue->VCategoryName;
        }
        $data['VCategoryList']=$ListArray;
	}



	if(in_array('it_services',$tables))
	{
		$data['SelectedService']="";
		$ci->db->select('*');
		$ci->db->order_by('ServiceName','asc');
 		$RoomCategoryList	= $ci->db->get('it_services')->result();
		$ListArray	=array();
		$ListArray[]="Select Service";
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->ServiceId]=$fieldvalue->ServiceName;
        }
        $data['ServiceList']=$ListArray;
	}




	if(in_array('it_items',$tables))
	{
		$data['SelectedItem']="";
		$ci->db->select('*');
		$ci->db->order_by('ItemCode','asc');
 		$RoomCategoryList	= $ci->db->get('it_items')->result();
		$ListArray	=array();
		$ListArray[]="Select Item";
        foreach ($RoomCategoryList as $fieldvalue) {
        	$ListArray[$fieldvalue->ItemId]=$fieldvalue->ItemCode;
        }
        $data['ItemList']=$ListArray;
	}



	if(in_array('it_allocation',$tables))
	{
		$data['SelectedAllocation']="";
		$ListArray = Array('Full Day'=>'Full Day','Half Day'=>'Half Day','Night Tour'=>'Night Tour');
        $data['AllocationList']=$ListArray;
	}
	

	if(in_array('it_yes_no',$tables))
	{
		$ListArray = Array('1'=>'Yes','0'=>'No');
        $data['YesNoList']=$ListArray;
	}

$data['noty_show']=false;

	return $data;
}




if ( ! function_exists('my_create_date_range_array'))
{
       
    function my_create_date_range_array($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script



        $timeStamp = strtotime($strDateTo);
        $timeStamp -= 24 * 60 * 60 * 1; // (-1 day) 3 days 2 nights
        $strDateTo = date("Y-m-d", $timeStamp);

        $aryRange=array();


        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
     return $aryRange;
    }
}





if ( ! function_exists('get_booking_reference_number'))
{
  function get_booking_reference_number($AgentId=0)
  {

      $ci = get_instance();

      $user_id=$ci->session->userdata('user_id');

      $ci->db->where('UserId',$user_id);
      $Query =  $ci->db->get('it_booking_cart');

/*
print_r($ci->db->queries);*/

        if($Query->num_rows>0)
        {

          $Result=$Query->result_array();
          $ReferenceNumber =  $Result[0]['BookingReferenceNumber'];  

        }
        else
        {
          $dRef = date("ym");

          $Query1 =  $ci->db->order_by('BookingReferenceNumber','desc');
          $Query1 =  $ci->db->limit(1,0);
          $Query1 =  $ci->db->get('it_booking');


            if($Query1->num_rows>0)
            {

              $Result=$Query1->result_array();
              $RefString = $Result[0]['BookingReferenceNumber'];
              $LastReferenceNumber =  str_split($RefString, 4);
              $ReferenceNumber=$LastReferenceNumber[0];
              

              if($ReferenceNumber == $dRef)
                {
                  $ReferenceNumber=$RefString+1;


                }
                else
                {
                  $ReferenceNumber= $dRef."000001";
                }

                //we are inserting values to maintain index
            

            }
            else
            {

                $ReferenceNumber = $dRef."000001";
            }
         
            $AdminId=$ci->session->userdata('user_id');
        }


        return $ReferenceNumber;



  }

}









if ( ! function_exists('get_sub_booking_reference_number'))
{
  function get_sub_booking_reference_number($MasterReferenceNumber=0)
  {
 $ci = get_instance();


                $ci->db->where('BookingReferenceNumber',$MasterReferenceNumber);
          $Query =  $ci->db->order_by('BookingCartId','desc');
          $Query =  $ci->db->limit(1,0);
          $Query =  $ci->db->get('it_booking_cart');


        $today = date("d");
        $checkDate = "1".$today;
      
  
        if($Query->num_rows>0)
        {
          $Result=$Query->result_array();
          $RefString = $Result[0]['SubBookingReferenceNumber'];
          $LastReferenceNumber =  explode('-',$RefString);
            



            $ReferenceNumber=$LastReferenceNumber[2];
            $SubReferenceNumberDay =  str_split($ReferenceNumber, 3);
  
 

            if($SubReferenceNumberDay[0] == $checkDate)
            { 
               $ReferenceNumber=$MasterReferenceNumber.'-TUR-'.($ReferenceNumber+1);
            }
            else
            {
              $ReferenceNumber= $MasterReferenceNumber.'-TUR-1'.$today."0001";
            }

        }
        else
        {
             $ReferenceNumber = $MasterReferenceNumber.'-TUR-1'.$today."0001";
        }
    

    return $ReferenceNumber;

  }
}





?>