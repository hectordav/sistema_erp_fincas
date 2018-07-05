<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informe_gasto_proveedor_model extends CI_Model {

	public function guardar_informe_gasto_proveedor($id_proveedor,$fecha_i,$fecha_f){
		$data = array('id_proveedor' =>$id_proveedor,
		'fecha_i' =>$fecha_i,
		'fecha_f' =>$fecha_f);
		$this->db->insert('t_informe_gasto_proveedor', $data);
	}
	public function get_max_informe_gasto_proveedor(){
		$this->db->select_max('id');
		$consulta=$this->db->get('t_informe_gasto_proveedor');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_informe_gasto_proveedor_id($id_informe_gasto_proveedor){
		$this->db->select('t_informe_gasto_proveedor.id as id_informe,t_informe_gasto_proveedor.fecha_i as fecha_i, t_informe_gasto_proveedor.fecha_f as fecha_f, t_informe_gasto_proveedor.total as total, t_proveedor.nombre as nombre_proveedor');
		$this->db->join('t_proveedor', 't_informe_gasto_proveedor.id_proveedor = t_proveedor.id', 'left');
		$this->db->where('t_informe_gasto_proveedor.id', $id_informe_gasto_proveedor);
		$consulta=$this->db->get('t_informe_gasto_proveedor');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_informe_gasto_proveedor_id($id_informe_gasto_proveedor){
		$this->db->select('t_det_informe_gasto_proveedor.id as id_det_informe,t_det_informe_gasto_proveedor.monto as monto_det_informe, t_det_informe_gasto_proveedor.fecha as fecha_det_informe,t_tipo_gasto_proveedor.descripcion as tipo_gasto_proveedor');
		$this->db->join('t_tipo_gasto_proveedor', 't_det_informe_gasto_proveedor.id_tipo_gasto_proveedor = t_tipo_gasto_proveedor.id', 'left');
		$this->db->where('t_det_informe_gasto_proveedor.id_informe_gasto_proveedor', $id_informe_gasto_proveedor);
		$consulta=$this->db->get('t_det_informe_gasto_proveedor');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function guardar_det_informe_gasto_proveedor($id_informe_gasto_proveedor,$id_tipo_gasto_proveedor,$monto,$fecha){
		$data = array('id_informe_gasto_proveedor'=>$id_informe_gasto_proveedor,
		'id_tipo_gasto_proveedor'=>$id_tipo_gasto_proveedor,
		'monto'=>$monto,
		'fecha'=>$fecha);
		$this->db->insert('t_det_informe_gasto_proveedor',$data);
	}
	public function get_suma_informe_gasto($id_informe_gasto_proveedor,$fecha_i,$fecha_f){
		$this->db->select('SUM(monto) as total');
		$this->db->where('id_informe_gasto_proveedor', $id_informe_gasto_proveedor);
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_informe_gasto_proveedor');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_monto_informe_gasto_proveedor($id_informe_gasto_proveedor,$total){
		$data = array('total' =>$total);
		$this->db->where('id', $id_informe_gasto_proveedor);
		$this->db->update('t_informe_gasto_proveedor', $data);
	}

}

/* End of file informe_gasto_proveedor_model.php */
/* Location: ./application/models/informe_gasto_proveedor_model.php */