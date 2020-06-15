<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use STAAFI\Libraries\RestController;
require(APPPATH.'libraries\RestController.php');
require(APPPATH.'libraries\Format.php');

class Perfiles extends RestController
{

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('PerfilesModel');
    }


    public function getPerfil_get()
    {
        $id = $this->get('id');
        if ($id === null)
        {
            $perfiles = $this->PerfilesModel->GetPerfiles();

            if (isset($perfiles))
            {
                $this->response($perfiles,200);
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'Ningún perfil encontrado'
                ], 404 );
            }

        }
        else
        {
            $perfil = $this->PerfilesModel->GetPerfil($id);

            if (isset($perfil))
            {
                $this->response($perfil,200);
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'Perfil no encontrado'
                ], 404 );
            }
        }
    }

    public function createPerfil_post()
    {
        header("Access-Control-Allow-Origin: *");
    
    }


    public function deletePerfil_delete($id)
    {
        header("Access-Control-Allow-Origin: *");

        $this->PerfilesModel->EliminarPerfil($id);
       
        $this->response(['Perfil eliminado de manera exitosa!'], 200);
    }
}
?>