<?php
     $url = "http://wasap.ga/api/v1/?token=rMeOP6yDe5XRz5JV";
     $data = array(
       'service' => "whatsapp",
       'message' => "Halo Dunia!",
       'user' => "6282240994099"
     );
     $options = array(
       'http' => array(
         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
         'method'  => 'POST',
         'content' => http_build_query($data),
       )
     );
     $context  = stream_context_create($options);
     $result = file_get_contents($url, false, $context);
 
     echo  "$result";
 ?>