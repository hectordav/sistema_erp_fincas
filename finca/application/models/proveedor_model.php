<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model {

	public function get_proveedor(){
		$consulta=$this->db->get('t_proveedor');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function contar_proveedores(){
    $this->db->from('t_proveedor');
    return $this->db->count_all_results();
  }

}

/* End of file proveedor_model.php */
/* Location: ./application/models/proveedor_model.php */