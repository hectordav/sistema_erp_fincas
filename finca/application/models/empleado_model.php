<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model {

	public function get_empleado(){
		$consulta=$this->db->get('t_empleado');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_empleado_id_empleado($id_empleado){
		$this->db->where('id', $id_empleado);
		$consulta=$this->db->get('t_empleado');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_empleado_cambio_finca_id_empleado($id_empleado){
		$this->db->select('t_empleado.id as id_empleado, t_empleado.nombre as nombre, t_finca.nombre as nombre_finca ');
		$this->db->join('t_finca', 't_empleado.id_finca = t_finca.id', 'left');
		$this->db->where('t_empleado.id', $id_empleado);
		$consulta=$this->db->get('t_empleado');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function actualizar_empleado_finca($id_empleado,$id_finca){
		$data = array('id_finca' =>$id_finca);
		$this->db->where('id', $id_empleado);
		$this->db->update('t_empleado', $data);
	}
	public function get_empleado_id_finca($id_finca){
		$this->db->select('t_empleado.id as id_empleado, t_empleado.cedula as cedula, t_empleado.nombre as nombre, t_empleado.direccion as direccion, t_empleado.telf as telf,t_empleado.id_seguro as id_seguro, t_seguro.descripcion as seguro');
		$this->db->join('t_seguro', 't_empleado.id_seguro = t_seguro.id', 'left');
		$this->db->where('t_empleado.id_finca', $id_finca);
		$consulta=$this->db->get('t_empleado');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_empleado($id_empleado,$id_seguro,$cedula,$nombre,$direccion,$telf){
		$data = array('id_seguro'=>$id_seguro,
		'cedula'=>$cedula,
		'nombre'=>$nombre,
		'direccion'=>$direccion,
		'telf'=>$telf);
		$this->db->where('id', $id_empleado);
		$this->db->update('t_empleado', $data);
	}
	public function borrar_empleado($id_empleado){
		$this->db->where('id', $id_empleado);
		$this->db->delete('t_empleado');
	}
	public function contar_empleado(){
    $this->db->from('t_empleado');
    return $this->db->count_all_results();
  }

}

/* End of file empleado_model.php */
/* Location: ./application/models/empleado_model.php */