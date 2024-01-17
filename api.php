<?php
    class Api{
        public function getClientes() {
            $list = array();
            $conexion = new Conexion();
            $db = $conexion->getConexion();
            $sql = "SELECT * FROM Clientes where estado='1'";
            $query = $db->prepare($sql);
            $query->execute();
            while($row = $query->fetch()){
                $list[]=array(
                "cliente_id" => $row['cliente_id'],
                "ruc_dni" => $row['ruc_dni'],
                "nombres" => $row['nombres'],
                "apellidos" => $row['apellidos'],
                "email" => $row['email'],
                "direccion" => $row['direccion'],
                "profile_picture" => $row['profile_picture']);

            }
            return $list;
        }
        public function getAlumnos() {
            $list = array();
            $conexion = new Conexion();
            $db = $conexion->getConexion();
            $sql = "SELECT * FROM alumnos where estado='1'";
            $query = $db->prepare($sql);
            $query->execute();
            while($row = $query->fetch()){
                $list[]=array(
                "id" => $row['id'],
                "nombres" => $row['nombres'],
                "direccion" => $row['direccion'],
                "sexo" => $row['sexo'],
                "edad" => $row['edad']
            );

            }
            return $list;
        }
        public function saveClientes($data){
            $id = intval($data['id']);
            $nombres = $data['nombres'];
            $direccion = $data['direccion'];
            $sexo = $data['sexo'];
            $edad = $data['edad'];
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            if($id != 0){
                $sql = "UPDATE alumnos SET 
                        nombres = :nombres,
                        direccion = :direccion,
                        sexo = :sexo,
                        edad = :edad
                        WHERE id = :id;";
                $query=$db->prepare($sql);
                $query->bindParam(':nombres',$nombres);
                $query->bindParam(':direccion',$direccion);
                $query->bindParam(':sexo',$sexo);
                $query->bindParam(':edad',$edad);
                $query->bindParam(':id',$id);
                $query->execute();
                return '{"msg":"Registro Editado"}';
            }else{
                $sql = "INSERT INTO clientes
                (ruc_dni,nombres,apellidos,email,direccion,estado, profile_picture) values
                (:ruc_dni,:nombres,:apellidos,:email,:direccion,'1', :profile_picture)";
                $query=$db->prepare($sql);
                $query->bindParam(':ruc_dni',$ruc_dni);
                $query->bindParam(':nombres',$nombres);
                $query->bindParam(':apellidos',$apellidos);
                $query->bindParam(':email',$email);
                $query->bindParam(':direccion',$direccion);
                $query->bindParam(':profile_picture',$profile_picture);
                $query->execute();
                return '{"msg":"Registro Agregado"}';
            }
            
            
        }

        public function saveAlumnos($data){
            $id = intval($data['id']);
            $nombres = $data['nombres'];
            $direccion = $data['direccion'];
            $sexo = $data['sexo'];
            $edad = $data['edad'];
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            if($id != 0){
                $sql = "UPDATE alumnos SET 
                        nombres = :nombres,
                        direccion = :direccion,
                        sexo = :sexo,
                        edad = :edad
                        WHERE id = :id;";
                $query=$db->prepare($sql);
                $query->bindParam(':nombres',$nombres);
                $query->bindParam(':direccion',$direccion);
                $query->bindParam(':sexo',$sexo);
                $query->bindParam(':edad',$edad);
                $query->bindParam(':id',$id);
                $query->execute();
                return '{"msg":"Registro Editado"}';
            }else{
                $sql = "INSERT INTO alumnos
                (nombres,direccion,sexo, edad, estado) values
                (:nombres,:direccion,:sexo, :edad,'1')";
                $query=$db->prepare($sql);
                $query->bindParam(':nombres',$nombres);
                $query->bindParam(':direccion',$direccion);
                $query->bindParam(':sexo',$sexo);
                $query->bindParam(':edad',$edad);        
                $query->execute();
                return '{"msg":"Registro Agregado"}';
            }
            
            
        }
        public function getClienteId($data){
            $id=$data['cliente_id'];
            $list=array();
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            $sql = "SELECT * FROM Clientes WHERE cliente_id = :cliente_id;";
            $query = $db->prepare($sql);
            $query->bindParam(':cliente_id',$id);
            $query->execute();
            while($row = $query->fetch()){
            $list[]=array(
            "cliente_id" => $row['cliente_id'],
            "ruc_dni" => $row['ruc_dni'],
            "nombres" => $row['nombres'],
            "apellidos" => $row['apellidos'],
            "email" => $row['email'],
            "direccion" => $row['direccion'],
            "profile_picture" => $row['profile_picture']
            );
            }
            return $list[0];
        }
        public function getAlumnoId($data){
            $id=$data['id'];
            $list=array();
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            $sql = "SELECT * FROM alumnos WHERE id = :id;";
            $query = $db->prepare($sql);
            $query->bindParam(':id',$id);
            $query->execute();
            while($row = $query->fetch()){
            $list[]=array(
                "id" => $row['id'],
                "nombres" => $row['nombres'],
                "direccion" => $row['direccion'],
                "sexo" => $row['sexo'],
                "edad" => $row['edad']
            );
            }
            return $list[0];
        }

        public function deleteCliente($data){
            $id=$data['cliente_id'];
            $list=array();
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            $sql = "UPDATE clientes SET 
                        estado = 0
                        WHERE cliente_id = :cliente_id;";
            $query=$db->prepare($sql);
            $query->bindParam(':cliente_id',$id);
            $query->execute();
            return '{"msg":"Registro Eliminado"}';
        }

        public function deleteAlumno($data){
            $id=$data['id'];
            $list=array();
            $conexion = new Conexion();
            $db=$conexion->getConexion();
            $sql = "UPDATE alumnos SET 
                        estado = 0
                        WHERE id = :id;";
            $query=$db->prepare($sql);
            $query->bindParam(':id',$id);
            $query->execute();
            return '{"msg":"Registro Eliminado"}';
        }
    }        
?>
