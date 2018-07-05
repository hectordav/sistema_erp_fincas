<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresos_model extends CI_Model {

	public function get_sum_ingreso_x_fecha($fecha_i,$fecha_f){
		$this->db->select('SUM(total) as total');
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_ingreso');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_ingreso_x_fecha($fecha_i,$fecha_f){
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_ingreso');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function sumar_ingresos_entre_fechas($fecha_i, $fecha_f){
			$this->db->select('fecha as fecha, sum(total) as total');
			$this->db->group_by('fecha');
      $this->db->where('fecha >=',$fecha_i);
      $this->db->where('fecha <=',$fecha_f);
      $consulta=$this->db->get('t_ingreso');
      if($consulta->num_rows() > 0){
        return $consulta->result();
      }
  }

}

/* End of file ingresos_model.php */
/* Location: ./application/models/ingresos_model.php */