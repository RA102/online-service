<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_type_id', 'faculty_id', 'edu_form_id', 'edu_level_id', 'lang_id', 'stage_id', 'course_num', 'sex_id', 'student_id', 'user_id', 'speciality_id'], 'integer'],
            [['fname', 'name', 'sname'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'profile_type_id' => $this->profile_type_id,
            'faculty_id' => $this->faculty_id,
            'edu_form_id' => $this->edu_form_id,
            'edu_level_id' => $this->edu_level_id,
            'lang_id' => $this->lang_id,
            'stage_id' => $this->stage_id,
            'course_num' => $this->course_num,
            'sex_id' => $this->sex_id,
            'student_id' => $this->student_id,
            'user_id' => $this->user_id,
            'speciality_id' => $this->speciality_id,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sname', $this->sname]);

        return $dataProvider;
    }
}
