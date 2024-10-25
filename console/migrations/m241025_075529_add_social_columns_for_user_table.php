<?php

use yii\db\Migration;

/**
 * Class m241025_075529_add_social_columns_for_user_table
 */
class m241025_075529_add_social_columns_for_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'firstname', $this->string()->after('username'));
        $this->addColumn('user', 'lastname', $this->string()->after('firstname'));
        $this->addColumn('user', 'sex', $this->boolean()->defaultValue(0)->after('email'));
        $this->addColumn('user', 'photo', $this->string()->after('sex'));
        $this->addColumn('user', 'birthday', $this->date()->after('photo'));
        $this->addColumn('user', 'vk_id', $this->string()->after('birthday'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'firstname');
        $this->dropColumn('user', 'lastname');
        $this->dropColumn('user', 'sex');
        $this->dropColumn('user', 'photo');
        $this->dropColumn('user', 'birthday');
        $this->dropColumn('user', 'vk_id');
    }
}
