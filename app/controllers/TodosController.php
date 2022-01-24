<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    protected $headerView = "@activeTheme/main/vHeader.html";
    protected $menuView = "@activeTheme/main/vMenu.html";
    protected $footerView = "@activeTheme/main/vFooter.html";

    public function initialize() {
        if (! URequest::isAjax()) {
            $this->loadView($this->headerView);
            $this->loadView($this->menuView);
        }
    }
    public function finalize() {
        if (! URequest::isAjax()) {
            $this->loadView($this->footerView);
        }
    }


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
		$val = URequest::post('value');
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
            $this->showMessage("Création de Liste", "La liste existe déjà");
        }
        else{
            USession::set("list", []);
            $list=USession::get('list', []);
            if(sizeof($list) > 0){
                $this->showMessage("Création de Liste", "Votre liste est créée");
                $this->displayList($list);
            }
            else{
                $this->showMessage("Création de Liste", "Votre liste est vide");
            }

        }
	}

	#[Get(path: "Todos/save",name: "todos.saveList")]
	public function saveList(){
		
	}

    public function showMessage(string $header, string $message, string $type = '', string $icon = 'info circle',array $buttons=[]) {
        $this->loadDefaultView(compact('header', 'type', 'icon', 'message','buttons'));
    }

    public function displayList(array $list) {
        echo "<h3>Début Liste :</h3>";
        foreach ($list as $i){
            echo $i;
        }
        echo "<h3>Fin Liste :</h3>";
    }

}
