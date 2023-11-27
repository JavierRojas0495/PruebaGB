<?php

include_once '../model/Usuario/UsuarioModel.php';


Class GstUsuario{

    function __construct(){
        $this->modelUsuario = new UsuarioModel();
    }


    public function ConsultarUsuario($id){
        

        try{    
            $sql=" SELECT id, nombre, email, sexo, edad, num_documento, num_telefono, direccion, ciudad FROM usuario WHERE id =".$id;
            $datos = $this->modelUsuario->consultarArray($sql);
        }catch(Exception $e){
            echo "Error al consultar Usuario";
            
        }
        
        return $datos;
    }

    public function UpdateUsuario($datos){
        
        $id_usuario = $datos['id_usuario'];
        $nombre = $datos['nombre'];
        $email = $datos['correo'];
        $sexo = $datos['sexo'];
        $edad = $datos['edad'];
        $numero_documento = $datos['numero_documento'];
        $numero_telefono = $datos['numero_telefono'];
        $direccion = $datos['direccion'];
        $ciudad = $datos['ciudad'];
        
        
        $usuario = $this->ConsultarUsuario($id_usuario);

        if($usuario != null){

            try{
                $sql = "UPDATE usuario SET nombre = '$nombre', email = '$email', sexo = '$sexo', edad = '$edad', num_documento = '$numero_documento', num_telefono = '$numero_telefono', direccion = '$direccion', ciudad = '$ciudad' where id = ".$id_usuario;
                
                $respuesta = $this->modelUsuario->editar($sql);
                var_dump($sql);
                $resultado = "Editado Exitoso";
            }catch(Exception $e){
                echo "Error al editar";
            }
            
        }else{

            $resultado = "Usuario No Existente";
        }
        return $resultado;
    }

    public function ConsultarUsuarios(){
        
        $sql = " SELECT U.id, U.nombre as name, U.num_documento as documento, U.email as correo, C.nombre as ciudad FROM usuario U INNER JOIN ciudades C ON C.id = U.ciudad ";
        $datos = $this->modelUsuario->consultarArray($sql);
        return $datos;
    }

    public function postRegistrarUsuario($datos){
        
        
        $nombre = $datos['nombre'];
        $email = $datos['correo'];
        $sexo = $datos['sexo'];
        $edad = $datos['edad'];
        $numero_documento = $datos['numero_documento'];
        $numero_telefono = $datos['numero_telefono'];
        $direccion = $datos['direccion'];
        $ciudad = $datos['ciudad'];
        $ruta_img = $datos['ruta_img'];
        $pass = "12345";
            
        try{
            $sql ="INSERT INTO usuario VALUES ('0','$nombre','$email','$sexo','$edad','$numero_documento','$numero_telefono','$direccion',$ciudad,'$ruta_img','$pass')";
            $resultado = $this->modelUsuario->insertar($sql);
            return "Registro Exitoso";
        }catch(Exception $e){
            //var_dump($sql);
            return "Error al insertar";
        }
        
        
    }

    public function eliminarUsuario($id){
        
        $sql ="delete from usuario where id=".$id;

        try{
            $this->modelUsuario->eliminar($sql);
            $resultado = "Eliminado";

        }catch(Exception $e){
            echo "Error al eliminar";
        }
        return $resultado;
        
    }

    public function getCiudad(){

        
        $sql = "select id,nombre from ciudades";
        $datos = $this->modelUsuario->consultarArray($sql);
        return $datos;
    }

}