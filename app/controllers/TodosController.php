<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    #[Route(path: "/_default",name: "home")]
	public function index(){
		if(USession::exists(self::ACTIVE_LIST_SESSION_KEY)){
            $list=USession::get('list', []);
            $this->loadDefaultView(compact('list'));
        }
        else{
            echo "Liste non Trouvée";
        }
	}

	#[Post(path: "Todos/add",name: "todos.addElement")]
	public function addElement(){
		
	}


	#[Get(path: "Todos/delete/{index}",name: "todos.deleteElement")]
	public function deleteElement($index){
		
	}


	#[Post(path: "Todos/edit/{index}",name: "todos.editElement")]
	public function editElement($index){
		
	}


	#[Get(path: "Todos/loadList/{uniqid}",name: "todos.loadList")]
	public function loadList($uniqid){
		
	}


	#[Post(path: "Todos/loadListPost",name: "todos.loadListFromForm")]
	public function loadListFromForm(){
		
	}


	#[Get(path: "Todos/new/{force}",name: "todos.newlist")]
	public function newlist($force=False){
		if(!$force){
            echo "La liste existe déjà et n'est pas vide";
        }
        else{
            echo "On créer la liste en Session";
        }
	}


	#[Get(path: "Todos/save",name: "todos.saveList")]
	public function saveList(){
		
	}

}
