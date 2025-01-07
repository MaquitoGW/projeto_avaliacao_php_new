<?php
/*
Classe de resposta e redirecionamento (PopUp)
*/
class Response
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function create($name, $response)
    {
        $_SESSION[$name] = $response;
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public function delete($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    public function redirect($location)
    {
        header("Location: " . $location);
        exit();
    }
}
