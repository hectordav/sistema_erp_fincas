<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finca_model extends CI_Model {

	public function get_finca(){
		$consulta=$this->db->get('t_finca');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_finca_nombre($finca){
		$this->db->where('nombre', $finca);
		$consulta=$this->db->get('t_finca');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_finca_id_finca($id_finca){
		$this->db->where('id', $id_finca);
		$consulta=$this->db->get('t_finca');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function contar_finca(){
    $this->db->from('t_finca');
    return $this->db->count_all_results();
  }

}

/* End of file finca_model.php */
/* Location: ./application/models/finca_model.php */