<?php

class Model{
    private $db;

    function __construct (){
        $this->db=$this->connect();
    }

    function connect(){
        $db=new PDO("mysql:host=localhost;"."dbname=tpe;charset=utf8;","root","");
        return $db;
    }

    function getAll($arranca=null,$elemPagina=null,$filtro=null,$orden=null,$forma=null){
        $query=$this->db->prepare("SELECT * FROM cancion WHERE anio = $filtro ORDER BY $orden $forma LIMIT $arranca, $elemPagina ");
        $query->execute();

        $canciones=$query->fetchAll(PDO::FETCH_OBJ);
        return $canciones;
    }
    

    function get($id){
        $query=$this->db->prepare("SELECT * FROM cancion WHERE id=?");
        $query->execute([$id]);
        $cancion=$query->fetch(PDO::FETCH_OBJ);
        return $cancion;
    }

    function editComent($comentario,$id){
        $query=$this->db->prepare("UPDATE cancion SET comentario=? WHERE id=?");
        $query->execute([$comentario,$id]);
    }


    function addCancion($nombre,$anio,$genero,$artista_id){
        $query=$this->db->prepare("INSERT INTO cancion (nombre,anio,genero,artista_id_fk) VALUES (?,?,?,?)");
        $query->execute([$nombre,$anio,$genero,$artista_id]);
    }

    

}