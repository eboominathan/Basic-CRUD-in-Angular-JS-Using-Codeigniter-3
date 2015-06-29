<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Angular_model extends CI_Model{

	Public function insert()

	{

	$data = json_decode(file_get_contents("php://input")); 
    $prod_name      = $data->prod_name;    
    $prod_desc      = $data->prod_desc;
    $prod_price     = $data->prod_price;
    $prod_quantity  = $data->prod_quantity;
 
    //print_r($data);
	
    $datas=array(
    	'prod_name'=>$prod_name,
    	'prod_desc'=>$prod_desc,
    	'prod_price'=>$prod_price,
    	'prod_quantity'=>$prod_quantity,
    	);
    $this->db->insert('product',$datas);
    return ($this->db->affected_rows()!=1)?false:true;
	}

	Public function update()
	{
		$data = json_decode(file_get_contents("php://input")); 
    $id             =   $data->id;
    $prod_name      =   $data->prod_name;    
    $prod_desc      =   $data->prod_desc;
    $prod_price     =   $data->prod_price;
    $prod_quantity  =   $data->prod_quantity;
   // print_r($data);
    
     $datas=array(
    	'prod_name'=>$prod_name,
    	'prod_desc'=>$prod_desc,
    	'prod_price'=>$prod_price,
    	'prod_quantity'=>$prod_quantity,
    	);

    	$this->db->where('id',$id);
    	$this->db->update('product',$data);
    	return ($this->db->affected_rows()!=1)?false:true;
	}

	Public function delete()
	{
		$data = json_decode(file_get_contents("php://input"));     
    	$index = $data->prod_index;  
    	$this->db->where('id',$index);
    	$this->db->delete('product');
    	return ($this->db->affected_rows()!=1)?false:true;

	}
}
