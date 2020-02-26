<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fname',
            'name',
            'sname',
            'profile_type_id',
            //'faculty_id',
            //'edu_form_id',
            //'edu_level_id',
            //'lang_id',
            //'stage_id',
            //'course_num',
            //'sex_id',
            //'student_id',
            //'user_id',
            //'speciality_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
