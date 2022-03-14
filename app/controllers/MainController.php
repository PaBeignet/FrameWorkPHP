<?php
namespace controllers;

 use models\Organization;
 use models\User;
 use services\dao\OrgaRepository;
 use services\ui\UIGroups;
 use Ubiquity\attributes\items\di\Autowired;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Post;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\URequest;
 use Ubiquity\utils\http\USession;

 /**
  * Controller MainController
  */
class MainController extends \controllers\ControllerBase{
    use WithAuthTrait;

    #[Autowired] //Permet d'injecter automatiquement à l'appel du controller une instance déjà crée du repository
    private OrgaRepository $repo;

    public function setRepo(OrgaRepository $repo): void {
        $this->repo = $repo;
    }

    public function initialize() {
        $this->ui=new UIGroups($this);
        parent::initialize();
    }

    #[Post('new/user', name: 'new.userPost')]
    public function newUserPost(){
        $idOrga=USession::get('idOrga');
        $orga=DAO::getById(Organization::class,$idOrga,false);
        $user=new User();
        URequest::setValuesToObject($user);
        $user->setEmail(\strtolower($user->getFirstname().'.'.$user->getLastname().'@'.$orga->getDomain()));
        $user->setOrganization($orga);
        if(DAO::insert($user)){
            $count=DAO::count(User::class,'idOrganization= ?',[$idOrga]);
            $this->jquery->execAtLast('$("#users-count").html("'.$count.'")');
            $this->showMessage("Ajout d'utilisateur","L'utilisateur $user a été ajouté à l'organisation.",'success','check square outline');
        }else{
            $this->showMessage("Ajout d'utilisateur","Aucun utilisateur n'a été ajouté",'error','warning circle');
        }
    }

    #[Get('new/user', name: 'new.user')]
    public function newUser(){
        $this->ui->newUser('frm-user');
        $this->jquery->renderView('main/vForm.html',['formName'=>'frm-user']);
    }

    #[Route('_default', name:'home')]
	public function index(){
        $user = $this->getAuthController()->_getActiveUser();
        $this->repo->byId(USession::get('idOrga'));
		$this->jquery->renderView('MainController/index.html', ['user'=>$user]);
	}

    protected function getAuthController(): AuthController
    {
        return new MyAuth($this);
    }

    private function showMessage(string $nom, string $messageValide, string $icon, string $iconStyle)
    {
        $this->loadView('MainController/showMessage.html', compact('nom','messageValide', 'icon', 'iconStyle'));
    }


}
