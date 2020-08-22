<?php 

require_once "conexion.php";

class ModeloCategorias
{
	/*=================================================
        Crear categorías
    =================================================*/

    static public function mdlIngresarCategoria($tabla, $datos)
    {
    	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nom_categoria) VALUES (:nom_categoria)");

    	$stmt->bindParam(":nom_categoria", $datos, PDO::PARAM_STR);

    	if($stmt->execute())
    	{
    		return "ok";
    	}
    	else
    	{
    		return "error";
    	}

    	$stmt->close();
    	$stmt = null;

    }

    /*=================================================
        Mostrar categorías    
    =================================================*/

    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {
        if($item != null)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }
        else
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt -> close();
        $stmt = null;

    }

    /*=================================================
        Editar categorías
    =================================================*/

    static public function mdlEditarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nom_categoria = :nom_categoria WHERE id = :id");

        $stmt->bindParam(":nom_categoria", $datos["nom_categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }

    /*=================================================
        Borrar categorías
    =================================================*/

    static public function mdlBorrarCategoria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }    


}	

?>