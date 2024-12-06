<?php
if (!function_exists('conectar')) {
    function conectar()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $bd = "rincon_del_movil";

        $con = mysqli_connect($host, $user, $pass, $bd);

        if (!$con) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        return $con;
    }
}
