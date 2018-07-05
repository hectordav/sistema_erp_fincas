<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguro_model extends CI_Model {

	public function get_seguro(){
		$consulta=$this->db->get('t_seguro');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
}
