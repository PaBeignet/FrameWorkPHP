<?php
namespace controllers\crud\files;

use Ubiquity\controllers\crud\CRUDFiles;
 /**
  * Class IndexCrudControllerFiles
  */
class IndexCrudControllerFiles extends CRUDFiles{
	public function getViewIndex(): string{
		return "IndexCrudController/index.html";
	}

	public function getViewForm(): string{
		return "IndexCrudController/form.html";
	}

	public function getViewDisplay(): string{
		return "IndexCrudController/display.html";
	}

	public function getViewHome(): string{
		return "IndexCrudController/home.html";
	}

	public function getViewItemHome(): string{
		return "IndexCrudController/itemHome.html";
	}

	public function getViewNav(): string{
		return "IndexCrudController/nav.html";
	}


}
