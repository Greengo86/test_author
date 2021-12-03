<?php
namespace frontend\models\rest;

class ViewAuthor extends Author
{
    public function fields()
    {
        $fields = parent::fields();
        $result = [
            'id' => $fields['id'],
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'birthday' => $fields['birthday'],
            'created_at' => $fields['created_at'],
            'updated_at' => $fields['updated_at'],
            'books' => function ($model) {
                $book = [];
                foreach ($model->books as $b) {
                    $book['name'] = $b->name;
                    $book['year'] = $b->year;
                }
                return $book;
            },
        ];
        if (isset($fields['bio'])) {
            $result['bio'] = $fields['bio'];
        }
        return $result;
    }
}