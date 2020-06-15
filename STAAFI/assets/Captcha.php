<?php
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
        $_SESSION['captcha']=$string;
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
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 

        #return the image
        header("Content-type: image/gif");
        imagejpeg($captcha);

?>