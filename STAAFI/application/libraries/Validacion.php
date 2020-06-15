<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validacion {
    
    /*
    public function __construct($params)
    {
        // Do something with $params
        $this->load->library('session');
    }
    */

    
    public function enviar_credenciales($correoTutor,$credLoginTutor,$credPassTutor) 
        {
            //Load email library
            $this->load->library('email');

            //SMTP & mail configuration
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'sistema.tutores.apoyo.fiuaemex@gmail.com',
                'smtp_pass' => 'TuTores||password2020',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");      
            
            //Email content
            $htmlContent = '<h2>CREDENCIALES DE ACCESO</h2>';
            $htmlContent .= '<br>';
            $htmlContent .= '<b>Estimado Tutor: </b>';
            $htmlContent .= '<br>';
            $htmlContent .= '<h4>Recientemente has sido añadido al <i>Sistema de Tutores Académicos de Apoyo de la Facultad de Ingeniería de la UAEMex</i>, por lo cual, se incluye en este correo el USUARIO y CONTRASEÑA para que puedas acceder al mismo. Una vez dentro, te recomendamos cambiar tu contraseña con una longitud mínima de 15 caracteres.</h4>';
            $htmlContent .= '<br>';
            $htmlContent .= '<h4>USUARIO: <b>'.$credLoginTutor.'</b></h4>';
            $htmlContent .= '<h4>CONTRASEÑA: <b>'.$credPassTutor.'</b></h4>';
            $this->email->to($correoTutor);
            $this->email->from('sistema.tutores.apoyo.fiuaemex@gmail.com','Sistema de Tutores Académicos de Apoyo de la Facultad de Ingeniería de la UAEMex');
            $this->email->subject('Credenciales de Acceso - Sistema de Tutores Académicos de Apoyo de la Facultad de Ingeniería de la UAEMex');
            $this->email->message($htmlContent);

            //Send email
            $this->email->send();

            $response = "Correo enviado!!!";
        }
    
    public function createRandomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    public function create_image()
    {
        $image = imagecreatetruecolor(200, 50);       
        $background_color = imagecolorallocate($image, 255, 255, 255);  
        imagefilledrectangle($image,0,0,200,50,$background_color); 
 
        $line_color = imagecolorallocate($image, 64,64,64);
        $number_of_lines=rand(3,7);
 
        for($i=0;$i<$number_of_lines;$i++)
        {
            imageline($image,0,rand()%50,250,rand()%50,$line_color);
        }
 
        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }  
 
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        $text_color = imagecolorallocate($image, 0,0,0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
            $word.=$letter;
        }
 
        $_SESSION['captcha_string'] = $word;
 
        imagepng($image, "captcha_image.png");
    }

    public function captcha() { 
        #create image and set background color
        $captcha = imagecreatetruecolor(120,35);
        $color = rand(128,170);
        $background_color = imagecolorallocate($captcha, 130, 130, 200);
        imagefill($captcha, 0, 0, $background_color);
        
        #draw some lines
        for($i=0;$i<8;$i++){
            $color = rand(0,32);
            imageline($captcha, rand(0,130),rand(0,35), rand(0,130), rand(0,35),imagecolorallocate($captcha, $color, $color, $color));
        }
        
        #generate a random string of 5 characters
        $string = substr(md5(rand()*time()),0,5);

        #make string uppercase and replace "O" and "0" to avoid mistakes
        $string = strtoupper($string);
        $string = str_replace("O","B", $string);
        $string = str_replace("0","C", $string);

        #save string in session "captcha" key
        session_start();
        $_SESSION["captcha"]=$string;
        //$this->session->set_userdata('captcha', $string);

        #place each character in a random position
        putenv('GDFONTPATH=' . realpath('.'));
        $font = 'arial.ttf';
        for($i=0;$i<5;$i++){
            $color = rand(0,32);
            if(file_exists($font)){
                $x=4+$i*23+rand(0,6);
                $y=rand(18,28);
                imagettftext  ($captcha, 15, rand(-25,25), $x, $y, imagecolorallocate($captcha, $color, $color, $color), $font, $string[$i]);
            }else{
                $x=5+$i*24+rand(0,6);
                $y=rand(1,18);
                imagestring($captcha, 5, $x, $y, $string[$i], imagecolorallocate($captcha, $color, $color, $color));
            }
        }
        
        #applies distorsion to image
        $matrix = array(array(1, 1, 1), array(1.0, 7, 1.0), array(1, 1, 1));
        imageconvolution($captcha, $matrix, 16, 32);

        #avoids catching
        /*
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        */
        #return the image
        //header("Content-type: image/png");
        //imagejpeg($captcha); 
        //imagepng($captcha,base_url()."assets/captcha_image.png");
        imagepng($captcha,"assets/captcha_image.png");
    }
}
?>