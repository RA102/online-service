<?php

use yii\db\Migration;

/**
 * Class m200225_111055_createTableProfile
 */
class m200225_111055_createTableProfile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'fname' => $this->string(),
            'name' => $this->string(),
            'sname' => $this->string(),
            'profile_type_id' => $this->integer(),
            'faculty_id' => $this->integer(),
            'edu_form_id' => $this->integer(),
            'edu_level_id' => $this->integer(),
            'lang_id' => $this->integer(),
            'stage_id' => $this->integer(),
            'course_num' => $this->integer(),
            'sex_id' => $this->integer(),
            'student_id' => $this->integer(),
            'user_id' => $this->integer(),
            'speciality_id' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200225_111055_createTableProfile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_111055_createTableProfile cannot be reverted.\n";

        return false;
    }
    */
}
