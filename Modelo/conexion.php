<?php
function conectar()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "rincon_del_movil";

    $con = mysqli_connect($host, $user, $pass, $bd);

    return $con;
}
