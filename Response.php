<?php 

namespace tarum\phpmvc;



/**
 * 
 * @package tarum\phpmvc
 * 
 */

 class Response
 {
     public function setStatusCode(int $code)
     {
         http_response_code($code);
     }

     public function redirect(string $url)
     {
         header("Location: " . $url);
     }
 }