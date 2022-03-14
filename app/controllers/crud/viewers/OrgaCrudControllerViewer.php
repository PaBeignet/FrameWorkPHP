<?php
namespace controllers\crud\viewers;

use Ajax\semantic\widgets\dataform\DataForm;
use Ajax\semantic\widgets\datatable\DataTable;
use Ubiquity\controllers\crud\viewers\ModelViewer;
 /**
  * Class OrgaCrudControllerViewer
  */
class OrgaCrudControllerViewer extends ModelViewer{
	//use override/implement Methods
    protected function getDataTableRowButtons(): array
    {
        return ['display','edit', 'delete']; //Les boutons disponibles sur chaque lignes
    }

    public function getModelDataTable($instances, $model, $totalCount, $page = 1): DataTable
    {
        //return parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt->fieldAsLabel('domain', 'car');
        $dt->setEdition(true);
        return $dt;
    }

    public function setFormFieldsComponent(DataForm $form, $fieldTypes, $attributes = [])
    {
        $form->fieldAsInput('id',['disabled'=>'disabled']);
    }
}
