<?php
function check_session()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['usuario_id'])) {
        $timeout = 3600; // 1 hora
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
            session_unset();
            session_destroy();
            header("Location: ../Inicio/login.php");
            exit();
        }

        $_SESSION['last_activity'] = time();
    }
}
