<?php

// i didn't understand both these things
function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
}

# it may be used a lot of times, so instead of writing in code everytime, do it for once here.
function get_safe_value($con, $str){
    if ($str!=''){
        $str = trim($str);          # if u don't do this, database takes '   car1' & 'car1' & 'car1  ' differently.
        return mysqli_real_escape_string($con, $str);
    }
}


?>