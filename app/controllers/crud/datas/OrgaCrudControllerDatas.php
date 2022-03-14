<?php
namespace controllers\crud\datas;

use Ubiquity\controllers\crud\CRUDDatas;
 /**
  * Class OrgaCrudControllerDatas
  */
class OrgaCrudControllerDatas extends CRUDDatas{
    public function getFieldNames(string $model): array
    {
        return ['name','domain'];
        //return parent::getFieldNames($model);
    }

    public function getFormFieldNames(string $model, $instance): array
    {
        $fields = parent::getFormFieldNames($model, $instance);
        $fields[]='groups'; //On ajoute le choix des groupes --> Même nom que dans le model
        $fields[]='users'; //On ajoute le choix des utilisateurs
        return $fields;
    }


    //use override/implement Methods
}
