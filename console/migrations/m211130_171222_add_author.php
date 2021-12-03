<?php

class m211130_171222_add_author extends \yii\mongodb\Migration
{
    const TABLE = 'author';

    public function up()
    {
        $this->createCollection(self::TABLE);
    }

    public function down()
    {
        $this->dropCollection(self::TABLE);
    }
}
