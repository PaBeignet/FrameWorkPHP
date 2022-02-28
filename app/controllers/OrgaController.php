<?php
namespace controllers;
use Ubiquity\attributes\items\router\Post;
 use models\Organization;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\ViewRepository;
use Ubiquity\utils\http\URequest;

/**
  * Controller OrgaController
  */
 #[Route('orga')]
class OrgaController extends \controllers\ControllerBase{
     private ViewRepository $repo;

     public function initialize() {
         parent::initialize();
         $this->repo??=new ViewRepository($this,Organization::class);
     }

     #[Get(name: 'orga.index')]
	public function index(){
        $orgas = $this->repo->all();
		$this->loadView("OrgaController/index.html");
	}

	#[Route(path: "/getOne/{idOrga}",name: "orga.getOne")]
	public function getOne($idOrga){
        //$orga = DAO::getById(Organization::class, $idOrga, ['users', 'groupes']);
        $orga=$this->repo->byId($idOrga,['users','groupes']);
        $this->loadView("OrgaController/getOne.html");
	}


	#[Get(path: "/add",name: "orga.addOne")]
	public function addOne(){
        $this->loadView("OrgaController/addOne.html");
	}

     #[Post(path: "/add",name: "orga.addOne")]
     public function addOnePost(){
         $orga=new Organization();
         URequest::setValuesToObject($orga);
         if(DAO::insert($orga)){
             $this->index();
         }
     }

     #[Get(path: "/update/{idOrga}",name: "orga.update")]
     public function update($idOrga){
         $orga=$this->repo->byId($idOrga,['name', 'domain', 'aliases']);
         $this->loadView("OrgaController/addOne.html");
     }

     #[Post(path: "/update/{idOrga}",name: "orga.update")]
     public function updatePost($idOrga){
         $orga=DAO::getById(Organization::class,$idOrga);
         URequest::setValuesToObject($orga);
         if(DAO::update($orga)){
             $this->index();
         }
     }

     #[Get(path: "/delete/{idOrga}",name: "orga.delete")]
     public function delete($idOrga){
         if(DAO::delete(Organization::class,$idOrga)){
             $this->index();
         }
     }



}
