<?php
    function reCaptcha() {
        $postData = '';
        $postData = $_POST; 
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secretKey = '6Lfbg78UAAAAAIrYXM6wnB0okjjDG45eKR4z57RW';
            // Verify the reCAPTCHA response 
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
            // Decode json data 
            $responseData = json_decode($verifyResponse); 
            // If reCAPTCHA response is valid
            if($responseData->success){
                return true;
            }
            else {
                echo "<script>alert('Robot validation failed! Please try again')</script>";
                return false;
            }
        }
        else{ 
            echo "<script>alert('Please check the reCaptcha box!')</script>";
            return false;
        }
    }
?>

