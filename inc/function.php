<?php

function debug($variable){
     echo '<pre>'. print_r($variable, TRUE).'</pre>';
}

function str_random($length){
    
    $alaphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
   
    return substr(str_shuffle(str_repeat($alaphabet, $length)), 0, $length);
}

