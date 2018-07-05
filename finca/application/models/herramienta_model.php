<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Herramienta_model extends CI_Model {

	public function get_herramienta(){
		$consulta=$this->db->get('t_herramienta');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_herramienta_id($id_herramienta){
		$this->db->where('id', $id_herramienta);
		$consulta=$this->db->get('t_herramienta',1);
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_herramienta_cantidad($id_herramienta,$suma_cantidad){
		$data = array('cantidad' =>$suma_cantidad);
		$this->db->where('id', $id_herramienta);
		$this->db->update('t_herramienta', $data);
	}
	public function contar_herramientas(){
    $this->db->from('t_herramienta');
    return $this->db->count_all_results();
  }
}

/* End of file inventario_model.php */
/* Location: ./application/models/inventario_model.php */