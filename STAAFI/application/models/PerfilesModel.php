<?php

class PerfilesModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function GetActividad($clave_actividad)
    {
        $this->db->select('clave_actividad,descripcion_actividad');
        $this->db->from('actividad');
        $this->db->where('clave_actividad',$clave_actividad);
        $query = $this->db->get();
        return $query->num_rows() > 0?$query->first_row('array'):NULL;
    }

    public function GetCatalogo($id_catalogo_actividad)
    {
        $this->db->select('clave_actividad,nombre_perfil');
        $this->db->from('catalogo_actividad');
        $this->db->where('id_catalogo_actividad',$id_catalogo_actividad);
        $query = $this->db->get();
        return $query->num_rows() > 0?$query->first_row('array'):NULL;
    }

    public function GetPerfiles()
    {
        $this->db->select('nombre_perfil');
        $this->db->from('perfil');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetActividades()
    {
        $this->db->select('clave_actividad,descripcion_actividad');
        $this->db->from('actividad');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetCatalogos()
    {
        $this->db->select('clave_actividad,nombre_perfil');
        $this->db->from('catalogo_actividad');
        $query = $this->db->get();
        return $query->result();
    }

    public function AgregarPerfil($nombre_perfil)
    {
        $data = array (
            'nombre_perfil' => $nombre_perfil
        );

        $result = $this->db->insert('perfil', $data);
  
        return $result;  
    }

    public function AgregarActividad($clave_actividad,$descripcion_actividad)
    {
        $data = array (
            'clave_actividad' => $clave_actividad,
            'descripcion_actividad' => $descripcion_actividad
        );

        $result = $this->db->insert('actividad', $data);
  
        return $result;  
    }

    public function AgregarCatalogo($clave_actividad,$nombre_perfil)
    {
        $data = array (
            'clave_actividad' => $clave_actividad,
            'nombre_perfil' => $nombre_perfil
        );

        $result = $this->db->insert('catalogo_actividad', $data);
  
        return $result;  
    }

    public function ActualizarActividad($clave_actividad,$descripcion_actividad)
    {
        $data = array (
            'clave_actividad' => $clave_actividad,
            'descripcion_actividad' => $descripcion_actividad
        );

        $result = $this->db->replace('actividad', $data);
  
        return $result;  
    }

    public function ActualizarCatalogo($clave_actividad,$nombre_perfil)
    {
        $data = array (
            'clave_actividad' => $clave_actividad,
            'nombre_perfil' => $nombre_perfil
        );

        $result = $this->db->replace('catalogo_actividad', $data);
  
        return $result;  
    }

    public function EliminarPerfil($nombre_perfil)
    {
        $this->db->where('nombre_perfil',$nombre_perfil);
        $this->db->delete('perfil');
    }

    public function EliminarActividad($clave_actividad)
    {
        $this->db->where('clave_actividad',$clave_actividad);
        $this->db->delete('actividad');
    }

    public function EliminarCatalogo($id_catalogo_actividadta)
    {
        $this->db->where('id_catalogo_actividad',$id_catalogo_actividad);
        $this->db->delete('catalogo_actividad');
    }

}

?>
