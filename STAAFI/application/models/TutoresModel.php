<?php

class TutoresModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function GetTutor($claveTutor)
    {
        $this->db->select('clave_tutor,nombre_tutor,apellido_paterno_tutor,apellido_materno_tutor,correo_tutor,es_colaborativo');
        $this->db->from('tutor');
        $this->db->where('clave_tutor',$claveTutor);
        $query = $this->db->get();
        return $query->num_rows() > 0?$query->first_row('array'):NULL;
    }

    public function GetTutores()
    {
        $this->db->select('clave_tutor,nombre_tutor,apellido_paterno_tutor,apellido_materno_tutor,correo_tutor,es_colaborativo');
        $this->db->from('tutor');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetTutorCredenciales($credLoginTutor)
    {
        $this->db->select('credenciales_login_tutor,credenciales_password_tutor');
        $this->db->from('tutor');
        $this->db->where('credenciales_login_tutor',$credLoginTutor);        
        $query =  $this->db->get();
        return $query->num_rows() > 0?$query->first_row('array'):NULL;
    }

    public function AgregarTutor($claveTutor,$nombreTutor,$apellidoPTutor,$apellidoMTutor,$correoTutor,$esColaborativo,$credLoginTutor,$credPassTutor) 
    {
        $data = array (
            'clave_tutor' => $claveTutor,
            'nombre_tutor' => $nombreTutor,
            'apellido_paterno_tutor' => $apellidoPTutor,
            'apellido_materno_tutor' => $apellidoMTutor,
            'correo_tutor' => $correoTutor,
            'es_colaborativo' => $esColaborativo,
            'credenciales_login_tutor' => $credLoginTutor,
            'credenciales_password_tutor' => $credPassTutor
        );

        $result = $this->db->insert('tutor', $data);
  
        return $result;  
    }

    public function ActualizarTutor($claveTutor,$nombreTutor,$apellidoPTutor,$apellidoMTutor,$correoTutor,$esColaborativo,$credLoginTutor)  
    {
        $data = array (
            'clave_tutor' => $claveTutor,
            'nombre_tutor' => $nombreTutor,
            'apellido_paterno_tutor' => $apellidoPTutor,
            'apellido_materno_tutor' => $apellidoMTutor,
            'correo_tutor' => $correoTutor,
            'es_colaborativo' => $esColaborativo,
            'credenciales_login_tutor' => $credLoginTutor
        );

        $result = $this->db->replace('tutor', $data);

        return $result;  
    }

    public function EliminarTutor($claveTutor)
    {
        $this->db->where('clave_tutor',$claveTutor);
        $this->db->delete('tutor');
    } 

}

?>
