<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gasto_proveedor_model extends CI_Model {

	public function guardar_det_gasto_proveedor($id_proveedor,$id_tipo_gasto_proveedor,$gasto,$fecha){
		$data = array('id_proveedor' =>$id_proveedor,
		'id_tipo_gasto_proveedor' =>$id_tipo_gasto_proveedor,
		'monto' =>$gasto,
		'fecha' =>$fecha);
		$this->db->insert('t_det_gasto_proveedor', $data);
	}
	public function get_gasto_proveedor_fechas($id_proveedor,$fecha_i,$fecha_f){
		$this->db->select('t_det_gasto_proveedor.id as id_det_gasto_proveedor, SUM(t_det_gasto_proveedor.monto) as monto, t_det_gasto_proveedor.id_tipo_gasto_proveedor as id_tipo_gasto_proveedor, t_det_gasto_proveedor.fecha as fecha');
		$this->db->group_by('t_det_gasto_proveedor.id_tipo_gasto_proveedor');
		$this->db->where('id_proveedor', $id_proveedor);
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_gasto_proveedor');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function sumar_gasto_proveedor_entre_fechas($fecha_i, $fecha_f){
			$this->db->select('fecha as fecha, sum(monto) as total');
			$this->db->group_by('fecha');
      $this->db->where('fecha >=',$fecha_i);
      $this->db->where('fecha <=',$fecha_f);
      $consulta=$this->db->get('t_det_gasto_proveedor');
      if($consulta->num_rows() > 0){
        return $consulta->result();
      }
  }

}

/* End of file gasto_proveedor_model.php */
/* Location: ./application/models/gasto_proveedor_model.php */