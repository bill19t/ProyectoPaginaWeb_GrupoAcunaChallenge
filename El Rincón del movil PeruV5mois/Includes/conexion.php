<?php
function conectar()
{
    $host = "localhost:3307";
    $user = "root";
    $pass = "";
    $bd = "rincon_del_movil";

    $con = mysqli_connect($host, $user, $pass, $bd);

    return $con;
}
