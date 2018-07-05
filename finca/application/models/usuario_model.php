<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function guardar_usuario($id_nivel,$nombre,$login,$clave_2){
		$data = array('id_nivel' =>$id_nivel,
		'nombre'=>$nombre,
		'login'=>$login,
		'clave'=>$clave_2);
		$this->db->insert('t_usuario', $data);
	}
	public function get_usuario_id_usuario($id_usuario){
		$this->db->select('t_usuario.id as id_usuario, t_usuario.nombre as nombre, t_usuario.login as login,t_usuario.id_nivel as id_nivel, t_nivel.descripcion as descripcion_nivel');
		$this->db->join('t_nivel', 't_usuario.id_nivel = t_nivel.id', 'left');
		$this->db->where('t_usuario.id', $id_usuario);
		$consulta=$this->db->get('t_usuario');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function actualizar_usuario($id_usuario,$id_nivel,$nombre,$login,$clave_2){
			$data = array('id_nivel' =>$id_nivel,
		'nombre'=>$nombre,
		'login'=>$login,
		'clave'=>$clave_2);
			$this->db->where('id', $id_usuario);
			$this->db->update('t_usuario', $data);
	}
	  public function login_manual($login,$clave){
    $this->db->select('t_usuario.id as id_usuario, t_usuario.nombre as nombre, t_usuario.login as login,t_usuario.id_nivel as id_nivel, t_nivel.descripcion as descripcion_nivel');
    $this->db->join('t_nivel', 't_usuario.id_nivel = t_nivel.id', 'left');
    $this->db->where('t_usuario.login', $login);
    $this->db->where('t_usuario.clave', $clave);
    $consulta=$this->db->get('t_usuario',1);
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
  }

}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */