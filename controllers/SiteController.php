<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use mdm\admin\models\Assignment;

use mdm\admin\models\form\Login as Login;
use mdm\admin\models\form\Signup;
use app\models\Profile;

use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }




    /**
     * Login action.
     *
     * @return Response|string
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        }
//
//        $model->password = '';
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }

    function univerLogin($data, $check = 0){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/web/cookie/'.$data['login'].'.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/web/cookie/'.$data['login'].'.txt' );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; ru; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3');

        $post = [
            'login' => $data['login'],
            'password' => $data['password'],
        ];

        curl_setopt($curl, CURLOPT_URL, $data['url_login']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        $html = curl_exec($curl);

        curl_setopt($curl, CURLOPT_URL, $data['url_stud']);
        $html = curl_exec($curl);

        $html = json_decode($html,true);
        //var_dump($html);die;
        if($html["code"] == 0){
            $data = array_merge($html["data"]["0"], $html["data"]["1"]);
            $arrays = array_values($data); // массив массивов данных Data

            for($i=0;count($arrays)>$i;$i++){
                $values[$i] = array_values($arrays[$i])[0];
                $keys[$i] = array_keys($arrays[$i])[0];
            }

            $array = array_combine($keys, $values);
            $object = (object)$array;
            return $object;
        }else{
            return false;
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();

        if ($model->load(Yii::$app->getRequest()->post())) {

            $auth_data = [
                "login"     =>  $model->username,
                "password"  =>  $model->password,
                "url_login"  =>  'https://univerapi.kstu.kz/user/login',
                "url_stud"  =>  'https://univerapi.kstu.kz/student/profile/ru-RU',
            ];

            // получили пользователя
            $user = $model->getUser($model->username);
            #var_dump(in_array ('curl', get_loaded_extensions()));die;
            if ($user == NULL){

                //есть ли доступ в универ
                $uCheck = $this->univerLogin($auth_data);

                #var_dump($uCheck);die;

                if($uCheck) {


                    // регистрация в системе
                    $model1 = new Signup();
                    $model1->username = $model->username;
                    $model1->password = $model->password;
                    $model1->retypePassword = $model->password;
                    $model1->email = $model->username . "@kstu.kz";

                    if ($signup = $model1->signup()){

                        $profile = new Profile();
                        $profile->fname = str_replace(":", "", stristr($uCheck->fname, ':'));
                        $profile->name = str_replace(":", "", stristr($uCheck->name, ':'));
                        $profile->sname = str_replace(":", "", stristr($uCheck->sname, ':'));
                        $profile->profile_type_id = 1;
                        $profile->faculty_id = str_replace(":", "", stristr($uCheck->faculty, ':'));
                        $profile->edu_form_id = str_replace(":", "", stristr($uCheck->edu_form, ':'));
                        $profile->edu_level_id = str_replace(":", "", stristr($uCheck->edu_level, ':'));
                        $profile->lang_id = str_replace(":", "", stristr($uCheck->lang_div, ':'));
                        $profile->stage_id = str_replace(":", "", stristr($uCheck->stage, ':'));
                        $profile->course_num = str_replace(":", "", stristr($uCheck->course_num, ':'));
                        $profile->sex_id = str_replace(":", "", stristr($uCheck->sex, ':'));
                        $profile->student_id = str_replace(":", "", stristr($uCheck->studentId, ':'));
                        $profile->user_id = $signup->id;
                        $profile->speciality_id = str_replace(":", "", stristr($uCheck->speciality, ':'));
                        $profile->save(false);

                        $model2 = new Login();

                        // авторизация в системе, редирект
                        $model2->load(Yii::$app->getRequest()->post());

                        if ($model2->login()) {
                            $profile_id = Profile::find()->where(['user_id'=>Yii::$app->user->id])->one();

                            $this->Assign(Yii::$app->user->id);

                            Yii::$app->session->set('profileId', $profile_id->id);
                            return $this->redirect(['site/login']);
                        }
                    }else{
                        var_dump('$model2->username');die();
                    }


                }else{
                    // НЕТ такого пользователя в системе UNIVER
                    Yii::$app->session->setFlash('warning', 'Ошибка. Логин или Пароль введены не верно');
                    return $this->redirect(['site/login']);
                    #var_dump();die();
                }

            }else{
                if($user && $user->validatePassword($model->password) == true){

                    // авторизация после регистрации в системе
                    if ($model->login()) {
                        $profile_id = Profile::find()->where(['user_id'=>Yii::$app->user->id])->one();
                        Yii::$app->session->set('profileId', $profile_id->id);
                        return $this->redirect(['site/login']);
                    }

                }else{
                    $uCheck = $this->univerLogin($auth_data);
                    if($uCheck){
                        // обновляем пароль в системе на новый из UNIVER
                        $user->setPassword($model->password);
                        $user->generateAuthKey();
                        if ($user->save()) {
                            return $this->redirect(['site/login']);
                        }
                    }else {
                        // НЕТ такого пользователя в системе UNIVER
                        Yii::$app->session->setFlash('warning', 'Ошибка, такой логин или пароль не найдены - UNIVER');
                        return $this->redirect(['site/login']);
                        #var_dump();die();
                    }                }
            }

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function Assign($id)
    {
        $items = [Yii::$app->params['USER_GROUP']];
        $model = new Assignment($id);
        $model->assign($items);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
