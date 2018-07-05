<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faena_model extends CI_Model {

	public function get_faena_descripcion($faena){
		$this->db->where('descripcion', $faena);
		$consulta=$this->db->get('t_faena');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_faena(){
		$consulta=$this->db->get('t_faena');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}

}

/* End of file faena_model.php */
/* Location: ./application/models/faena_model.php */