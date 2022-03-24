<?php
namespace controllers;
 use models\Product;
 use models\Section;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\UResponse;
 use Ubiquity\utils\http\USession;
 use function Sodium\add;

 /**
  * Controller StoreController
  */
class StoreController extends \controllers\ControllerBase{
    use WithAuthTrait;

    public function initialize()
    {
        USession::start();
        $this->view->setVar('nbProduct', 0);
        $this->view->setVar('totalPrice', 0);
        if(USession::exists('nbProduct')){
            $nbProduct = USession::get('nbProduct');
            $totalPrice = USession::get('totalPrice');
            $this->view->setVar('nbProduct', $nbProduct);
            $this->view->setVar('totalPrice', $totalPrice);
        }

        parent::initialize();
    }

    public function finalize()
    {
        $this->loadView('main/vFooter.html');
    }

    #[Route('_default', name:'home')]
	public function index(){
        $count=DAO::count(Product::class);
        $sections=DAO::getAll(Section::class);
		$this->loadView('StoreController/index.html', compact('count', 'sections'));
	}

	#[Route(path: "store/section/{idSection}",name: "store.section")]
	public function section($idSection){
		$section=DAO::getById(Section::class,$idSection, ['products']);
        $trucAfficher=$section->getProducts();
        $title = 'Section';
        $subTitle = $section->getName();
		$this->loadView('StoreController/section.html', compact('trucAfficher', 'title', 'subTitle'));

	}


	#[Route(path: "store/addToCart/{idProduct}/{count}",name: "store.addToCart")]
	public function addToCart($idProduct,$count){
        USession::start();

        $product=DAO::getById(Product::class,$idProduct);

        if(USession::exists($idProduct)){
            $countId = USession::get($idProduct);
            USession::set($idProduct, $countId+$count);
        }
        else{
            USession::set($idProduct, $count);
        }

        if(USession::exists('nbProduct')){
            $countNbProduct = USession::get('nbProduct');
            USession::set('nbProduct', $countNbProduct+$count);
        }
        else{
            USession::set('nbProduct', $count);
        }

        if(USession::exists('totalPrice')){
            $countTotalPrice = USession::get('totalPrice');
            USession::set('totalPrice', $countTotalPrice + $product->getPrice());
        }
        else{
            USession::set('totalPrice', $product->getPrice());
        }

        UResponse::header('location', '/');
	}


	#[Route(path: "store/allProducts",name: "store.allProducts")]
	public function allProducts(){
        $products=DAO::getAll(Product::class);
        $count=DAO::count(Product::class);
        $trucAfficher=$products;
        $title='Tous les produits';
        $subTitle=$count." références";
		$this->loadView('StoreController/section.html', compact('trucAfficher', 'title', 'subTitle'));
	}

    protected function getAuthController(): AuthController
    {
        return new StoreAuthController($this);
    }

    public function isValid($action)
    {
        return true;
    }
}
