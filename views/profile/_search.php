<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sname') ?>

    <?= $form->field($model, 'profile_type_id') ?>

    <?php // echo $form->field($model, 'faculty_id') ?>

    <?php // echo $form->field($model, 'edu_form_id') ?>

    <?php // echo $form->field($model, 'edu_level_id') ?>

    <?php // echo $form->field($model, 'lang_id') ?>

    <?php // echo $form->field($model, 'stage_id') ?>

    <?php // echo $form->field($model, 'course_num') ?>

    <?php // echo $form->field($model, 'sex_id') ?>

    <?php // echo $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'speciality_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
