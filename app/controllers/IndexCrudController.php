<?php
namespace controllers;
use controllers\crud\datas\IndexCrudControllerDatas;
use Ubiquity\controllers\crud\CRUDDatas;
use controllers\crud\viewers\IndexCrudControllerViewer;
use Ubiquity\controllers\crud\viewers\ModelViewer;
use controllers\crud\events\IndexCrudControllerEvents;
use Ubiquity\controllers\crud\CRUDEvents;
use controllers\crud\files\IndexCrudControllerFiles;
use Ubiquity\controllers\crud\CRUDFiles;
use Ubiquity\attributes\items\router\Route;

#[Route(path: "/crud/{resource}",inherited: true,automated: true)]
class IndexCrudController extends \Ubiquity\controllers\crud\MultiResourceCRUDController{

    public function initialize()
    {
        $this->headerView='@activeTheme/main/vHeader.html';
        $this->footerView='@activeTheme/main/vFooter.html';
        parent::initialize();
    }

    #[Route(name: "crud.index",priority: -1)]
	public function index() {
		parent::index();
	}


	#[Route(path: "#//crud/home",name: "crud.home",priority: 100)]
	public function home(){
		parent::home();
	}

	protected function getIndexType():array {
		return ['four link cards','card'];
	}

    protected function getIndexDefaultIcon(string $resource): string
    {
        $array=['organization'=>'dragon orange', 'group'=>'users blue', 'user'=>'user green']; //On dit que l'organization a l'icone dragon de couleur orange et ainsi de suite
        return $array[$resource];
    }

    protected function getIndexModels(): array
    {
        return ['user', 'group', 'organization'];
    }

    protected function getIndexDefaultTitle(string $resource): string
    {
        $array=['user'=>'Utilisateurs', 'group'=>'Groupes', 'organization'=>'Organisations'];
        return $array[$resource];
    }


    protected function getIndexDefaultDesc(string $modelClass): string
    {
        $array=['user'=>'Les utilisateurs', 'group'=>'Les groupes', 'organization'=>'Les organisations'];
        return $array[$modelClass];
    }


    public function _getBaseRoute():string {
		return "/crud/".$this->resource."";
	}
	
	protected function getAdminData(): CRUDDatas{
		return new IndexCrudControllerDatas($this);
	}

	protected function getModelViewer(): ModelViewer{
		return new IndexCrudControllerViewer($this,$this->style);
	}

	protected function getEvents(): CRUDEvents{
		return new IndexCrudControllerEvents($this);
	}

	protected function getFiles(): CRUDFiles{
		return new IndexCrudControllerFiles();
	}


}
