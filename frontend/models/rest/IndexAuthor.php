<?php
namespace frontend\models\rest;

class IndexAuthor extends Author
{
    public function fields()
    {
        $fields = parent::fields();
        return [
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'birthday' => $fields['birthday'],
        ];
    }
}