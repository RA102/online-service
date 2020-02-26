<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_type_id')->textInput() ?>

    <?= $form->field($model, 'faculty_id')->textInput() ?>

    <?= $form->field($model, 'edu_form_id')->textInput() ?>

    <?= $form->field($model, 'edu_level_id')->textInput() ?>

    <?= $form->field($model, 'lang_id')->textInput() ?>

    <?= $form->field($model, 'stage_id')->textInput() ?>

    <?= $form->field($model, 'course_num')->textInput() ?>

    <?= $form->field($model, 'sex_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'speciality_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
