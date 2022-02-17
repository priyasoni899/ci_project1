<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manager_page extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Manager_model');
        $this->load->library(array('form_validation','session'));
    }   
    public function addPatient() {
                $hospital_name = $this->Manager_model->fetch_hospital_data();
                $patient_name= $this->input->post('patient_name');
                $phone_number = $this->input->post('pnumber');
                $email = trim($this->input->post('email'));
                $department = $this->input->post('department');
                $hospital = $this->input->post('hospital');

                $this->form_validation->set_rules('patient_name', 'Name', 'trim|required');
                $this->form_validation->set_rules('pnumber', 'Phone Number', 'trim|required|regex_match[/^[0-9]{10}$/]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[patient.email]');
                $this->form_validation->set_rules('department', 'Department', 'trim|required');
                $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required');
                $data['hospital_name'] = $hospital_name;
                // Validation
                if ($this->form_validation->run() === true) {
                    $insert_data = array('name' => $patient_name, 'email' => $email,'phone_number'=>$phone_number, 'hospital_id' => $hospital, 'department_id' => $department, 'created_date'=> time());
                    $this->Manager_model->add_patient($insert_data);
                    $this->session->set_flashdata('success', 'User created successfully.');
                    redirect('Manager_page/addPatient', 'refresh');
               }
               $this->load->view('manager_page_view',$data);
            
    }  
    public function getDepartmentData(){
       if($_POST['dep_id'] && $_POST['dep_id']  != 0){
        $dep_id_arr=  explode(',',$_POST['dep_id']);
        $dep_id_str =  "'" . implode("','", $dep_id_arr) . "'";
        $result = $this->db->query("select * from department where id IN ($dep_id_str)");
        $res = $result->result_array();
        foreach($res as $val){
            $data['dep_data'][$val['id']] = $val['department_name'];
            $data['status']  = 200;
        }
       }else{
            $data['status']  = 400;
       }
        echo json_encode($data);
    }

    public function searchListing() {
        $where =  $data = [];
        $number = $this->input->get('number');
        $email   = $this->input->get('email');
        if ($number){
            $where['number'] = $number;
            $data['number'] = $number;          
        }else{
            $data['number'] = '';   
        }
        if ($email){
            $where['email'] = $email;
            $data['email'] = $email;          
        }else{
            $data['email'] = '';   

        }
        $result = $this->Manager_model->get_listing_data($where);
        if($result){
        $data['result'] = $result;
        }else{
         $data['result'] = [];
        }
        $this->load->view('listing',$data);  
    }         
    
}
?>