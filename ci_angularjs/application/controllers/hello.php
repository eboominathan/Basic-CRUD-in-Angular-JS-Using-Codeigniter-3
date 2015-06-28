<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Hello extends CI_Controller{
   function __construct()
    {
        parent::__construct();
        $this->load->model('angular_model');
    }   

    public function index() {
        
        $this->load->view('design/header');
        $this->load->view('hello/index');
        $this->load->view('design/footer');
    }
     Public function create()
    {
    	$this->load->view('design/header');
        $this->load->view('hello/create');
        $this->load->view('design/footer');

    }
    Public function get_details()
    {
            
    $data = array();
        $output=$this->db->get('product')->result_array();
        foreach($output as $rows)
        {
        $data[] = array(
                    "id"            => $rows['id'],
                    "prod_name"     => $rows['prod_name'],
                    "prod_desc"     => $rows['prod_desc'],
                    "prod_price"    => $rows['prod_price'],
                    "prod_quantity" => $rows['prod_quantity']
                    );
        }
    print_r(json_encode($data));
    return json_encode($data); 
    }

    Public function insert()
    {
        
            $result=$this->angular_model->insert();
            if($result)
            {
                $arr = array('msg' => "Product Added Successfully!!!", 'error' => '');
                $jsn = json_encode($arr);
            }
            else
            {
            $arr = array('msg' => "", 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            }
        }

        public function edit()
        {
            $data = json_decode(file_get_contents("php://input"));     
            $index = $data->prod_index; 

            $this->db->where('id',$index);
            $output=$this->db->get('product')->result_array();
            $data = array();
            foreach($output as $rows)
            {
            $data[] = array(
                    "id"            =>  $rows['id'],
                    "prod_name"     =>  $rows['prod_name'],
                    "prod_desc"     =>  $rows['prod_desc'],
                    "prod_price"    =>  $rows['prod_price'],
                    "prod_quantity" =>  $rows['prod_quantity']
                    );
            }
                print_r(json_encode($data));
                return json_encode($data);  
        }


        Public function update()
        {
            $result=$this->angular_model->update();
            if($result)
            {
                $arr = array('msg' => "Product Updated Successfully!!!", 'error' => '');
                $jsn = json_encode($arr);
            }
            else
            {
            $arr = array('msg' => "", 'error' => 'Error In updating record');
            $jsn = json_encode($arr);
            }
        }

        Public function delete()
        {
            $result=$this->angular_model->delete();
            if($result)
            {
                $arr = array('msg' => "Product Deleted Successfully!!!", 'error' => '');
                $jsn = json_encode($arr);
            }
            else
            {
            $arr = array('msg' => "", 'error' => 'Error In delting record');
            $jsn = json_encode($arr);
            }
        }
}
