<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string|null $fname
 * @property string|null $name
 * @property string|null $sname
 * @property int|null $profile_type_id
 * @property int|null $faculty_id
 * @property int|null $edu_form_id
 * @property int|null $edu_level_id
 * @property int|null $lang_id
 * @property int|null $stage_id
 * @property int|null $course_num
 * @property int|null $sex_id
 * @property int|null $student_id
 * @property int|null $user_id
 * @property int|null $speciality_id
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_type_id', 'faculty_id', 'edu_form_id', 'edu_level_id', 'lang_id', 'stage_id', 'course_num', 'sex_id', 'student_id', 'user_id', 'speciality_id'], 'integer'],
            [['fname', 'name', 'sname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'name' => 'Name',
            'sname' => 'Sname',
            'profile_type_id' => 'Profile Type ID',
            'faculty_id' => 'Faculty ID',
            'edu_form_id' => 'Edu Form ID',
            'edu_level_id' => 'Edu Level ID',
            'lang_id' => 'Lang ID',
            'stage_id' => 'Stage ID',
            'course_num' => 'Course Num',
            'sex_id' => 'Sex ID',
            'student_id' => 'Student ID',
            'user_id' => 'User ID',
            'speciality_id' => 'Speciality ID',
        ];
    }
}
