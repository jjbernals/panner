<?php

include_once 'conexion.php';

class Register extends Conexion
{

    public function conInsert($usuario, $correo, $contra)
    {
        $sql = 'INSERT INTO LOGINDB (nombre, email, PASSWORD) VALUES 
           ("' . $usuario . '","' . $correo . '", "' . $contra . '")';
        $consulta = $this->conectar()->query($sql);
        return $consulta;
    }

    public function validarForm()
    {

        if (isset($_POST['submitBtnReg'])) {
            if (empty($_POST['usuarioReg']) && empty($_POST['passwordReg'])) {
                echo '<script>alert("No pueden haber campos vacios");</script>';
            } else {
                $usuario = $_POST['usuarioReg'];
                $correo = $_POST['correoReg'];
                $contra = $_POST['passwordReg'];
                $contEncp = password_hash($contra, PASSWORD_DEFAULT);
                $this->conInsert($usuario, $correo, $contEncp);
                $this->iniciarSesion($usuario);
            }
        }
    }

    public function iniciarSesion($usuario)
    {
        session_start();
        $_SESSION["Usuario"] = $usuario;
        header('location: access/index.php');
    }
}

?>