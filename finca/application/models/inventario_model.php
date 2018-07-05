<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_model extends CI_Model {

	public function guardar_inventario($id_empleado,$fecha){
		$data = array('id_empleado'=>$id_empleado,
		'fecha'=>$fecha);
		$this->db->insert('t_inventario', $data);
	}
	public function get_inventario_id_inventario($id_inventario){
		$this->db->select('t_inventario.id as id_inventario, t_inventario.observacion as observacion, t_inventario.fecha as fecha, t_empleado.nombre as nombre_empleado');
		$this->db->join('t_empleado', 't_inventario.id_empleado = t_empleado.id', 'left');
		$this->db->where('t_inventario.id', $id_inventario);
		$consulta=$this->db->get('t_inventario');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_det_inventario_id_inventario($id_inventario){
		$this->db->select('t_det_inventario.id as id_det_inventario, t_det_inventario.cantidad as cantidad,t_det_inventario.id_herramienta as id_herramienta, t_herramienta.descripcion as descripcion_herramienta');
		$this->db->join('t_herramienta', 't_det_inventario.id_herramienta = t_herramienta.id', 'left');
		$this->db->where('t_det_inventario.id_inventario', $id_inventario);
		$consulta=$this->db->get('t_det_inventario');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function actualizar_observacion_inventario($id_inventario,$observaciones){
		$data = array('observacion' =>$observaciones);
		$this->db->where('id', $id_inventario);
		$this->db->update('t_inventario', $data);
	}
	public function guardar_det_inventario($id_inventario,$id_herramienta,$cantidad){
		$data = array('id_inventario'=>$id_inventario,
			'id_herramienta' =>$id_herramienta,
		'cantidad'=>$cantidad);
		$this->db->insert('t_det_inventario', $data);
	}
	public function actualizar_det_inventario_manual($id_det_inventario,$id_herramienta,$cantidad_nueva){
		$data = array('id_herramienta' => $id_herramienta,
		'cantidad'=>$cantidad_nueva);
		$this->db->where('id', $id_det_inventario);
		$this->db->update('t_det_inventario', $data);
	}

}

/* End of file inventario_model.php */
/* Location: ./application/models/inventario_model.php */