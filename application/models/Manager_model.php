<?php
class Manager_model extends CI_Model{
private $tblPatient = 'patient';
private $tblHospital = 'hospital';
private $tblDepartment = 'department';

function add_patient($data){
 $this->db->insert($this->tblPatient,$data);
 return true;
}

function fetch_hospital_data(){
    $this->db->select("a.*");
    $this->db->from($this->tblHospital.' as a');
    $res = $this->db->get();
    return $result = $res->result_array();
 }
 public function get_listing_data($where) {
    $this->db->select('a.*,b.hospital_name,c.department_name');
    $this->db->from($this->tblPatient. ' as a');
    $this->db->join($this->tblHospital. ' as b','a.hospital_id = b.id', 'left');
    $this->db->join($this->tblDepartment. ' as c', 'a.department_id = c.id','left');
    if(isset($where['number'])){
        $this->db->where('phone_number', $where['number']);
    }
    if(isset($where['email'])){
        $this->db->where('email', $where['email']);
    }  
    if(isset($where['email']) || isset($where['number'])){   
    $this->db->order_by("a.id", "desc");
    $query = $this->db->get();
    $row = $query->result();
    return $row;
  }
}
}
?>