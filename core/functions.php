<?php
function model($name){
    include "./model/$name" . '.php';
    return new $name;
}
function view($name, $data)
{
    include "./view/includes/main.php";
    return $data;
}


// dont touch this file