<?php
 function filterPost($input) {
   $string = $input;
   $string = str_replace(['"',"'"], "", $input);
   $string = str_replace('>', '', $string);
   $string = strip_tags($string);
   return $string;
 }

?>