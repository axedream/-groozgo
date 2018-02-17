<?php

use yii\db\Migration;

/**
 * Class m180216_020951_addTablesFromAddresAddresWithUers
 */
class m180216_020951_addTablesFromAddresAddresWithUers extends Migration
{
    public function up()
    {
        $this->createTable('address',[
            'id'=>$this->primaryKey(),
            'address'=>$this->string(255),
        ]);

        $this->createTable('address_user',[
            'id'=>$this->primaryKey(),
            'address_id'=>$this->integer(11),
            'user_id'=>$this->integer(11),
        ]);
    }

    public function down()
    {
        $this->dropTable('address');
        $this->dropTable('address_user');
    }

}
