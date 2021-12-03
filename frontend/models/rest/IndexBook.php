<?php
namespace frontend\models\rest;

class IndexBook extends Book
{
    public function fields()
    {
        $fields = parent::fields();

        return [
            'name' => $fields['name'],
            'year' => $fields['year'],
            'author_name_surname' => function ($model) {
                $author = $model->author;
                return !empty($author) ? $author[0]->name . ' ' . $author[0]->surname : '';
            },
        ];
    }

}