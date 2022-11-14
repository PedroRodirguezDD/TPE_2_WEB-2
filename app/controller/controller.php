<?php

include_once "app/model/model.php";
include_once "app/view/view_api.php";

class Controller{
    private $model;
    private $view;
    private $data;

    function __construct(){
        $this->model=new Model();
        $this->view=new ViewApi();
        $this->data=file_get_contents("php://input");
    }

    function getData(){
        return json_decode($this->data);
    }


    function getAll(){
        

        if(isset($_GET['pagina']) || isset($_GET['anio']) || isset($_GET['orden'])){

            //PUNTO OPCIONAL 7
            if(isset($_GET['pagina'])){

                $elemPagina=2;
                $canciones=$this->model->getAll(0,100,'anio','id');
                $cantidad=(count($canciones)/$elemPagina) + 1;

                if($_GET['pagina']==1){
                    $pagina=1;
                }
                else{
                    $pagina=$_GET['pagina'];
                }
                
                if($pagina>0 && $pagina<$cantidad){
                    $arranca=($pagina-1) * $elemPagina;
                    $canciones=$this->model->getAll($arranca,$elemPagina,'anio','id');
                    $this->view->response($canciones,200);
                }
                else{
                    $this->view->response("Este numero de pagina no existe",400);
                }
                
            }
            

            //PUNTO OPCIONAL 8
            if(isset($_GET['anio'])){
                $filtro=$_GET['anio'];
                $canciones=$this->model->getAll(0,100,'anio','id');

                foreach($canciones as $cancion){
                    if($cancion->anio == $filtro){
                        $filtrado=$this->model->getAll(0,100,$filtro,'id');   
                        $this->view->response($filtrado,200);
                        die();
                    }
                }
                $this->view->response("No hay canciones que se allan lanzado este año",400);
                
            }


            //PUNTO OPCIONAL 9
            if(isset($_GET['orden'])){
                $orden=$_GET['orden'];

                if($orden=='nombre' || $orden=='id' || $orden=='anio' || $orden=='genero' || $orden=='comentario' || $orden=='artista_id_fk'){

                    if(isset($_GET['forma'])){

                        $forma=$_GET['forma'];
                            
                        if($forma=="desc" || $forma=="asc"){
                            $canciones=$this->model->getAll(0,100,'anio',$orden,$forma);
                            $this->view->response($canciones,200);
                        }
                        else{
                            $this->view->response('No existe la forma de ordenar que estas introduciendo',400);
                        }
                    }
                    else{
                        $canciones=$this->model->getAll(0,100,'anio',$orden);
                        $this->view->response($canciones,200);
                    }

                }
                else{
                    $this->view->response('No puedes ordenar la coleccion de esta manera',400);
                }
                
            }

        }
        else{
            $canciones=$this->model->getAll(0,100,'anio','id');
            $this->view->response($canciones,200);
        }

    }

    function get($params=null){

        $id=$params[':ID'];
        $cancion=$this->model->get($id);

        if($cancion){
            $this->view->response($cancion,200);
        }
        else{
            $this->view->response("No existe ninguna cancion con este id:$id ",404);
        }
    }

    
    function editComent($params=null){
        
        $id=$params[':ID'];
        $cancion=$this->model->get($id);

        if($cancion){
            $coment=$this->getData();
            if(!empty($coment->comentario)){
                $this->model->editComent($coment->comentario,$id);
                $this->view->response("Se agrego con exito un comentario a la cancion seleccionada ",200);
            }
            else{
                $this->view->response("Debes escribir un comentario para agregar a la cancion",400);
            }
        }
        else{
            $this->view->response("No puedes agregar comentario ya que no hay canciones con este id:$id ",404);
        }
    }
    

    function addCancion($params=null){
        $cancion=$this->getData();
        if(!empty($cancion->nombre) && !empty($cancion->anio) && !empty($cancion->genero) && !empty($cancion->artista_id)){
            if($cancion->artista_id == 1 || $cancion->artista_id == 2 || $cancion->artista_id == 14){
                $this->model->addCancion($cancion->nombre,$cancion->anio,$cancion->genero,$cancion->artista_id);
                $this->view->response("La tarea se añadio correctamente",201);
            }
            else{
                $this->view->response("El id del artista que introduciste no pertenece a ningun artista contenido, introduzca uno valido",400);
            }
        }
        else{
            $this->view->response("Debes completar los datos que te faltan",400);
        }
    }


    

    
}