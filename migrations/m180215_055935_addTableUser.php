<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m180215_055935_addTableUser extends Migration
{

    public function up()
    {
        $this->createTable('user',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'surname'=>$this->string(255),
            'birth'=>$this->date(),
            'sex'=>$this->integer()->defaultValue(0),
            'phone_number'=>$this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }

}
