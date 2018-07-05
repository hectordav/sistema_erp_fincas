<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mes_model extends CI_Model {

	public function get_mes(){
		$consulta=$this->db->get('t_mes');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}	

}

/* End of file mes_model.php */
/* Location: ./application/models/mes_model.php */