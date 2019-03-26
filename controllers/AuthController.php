<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * Login action
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $this->layout = 'nosidebar';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->login()) {

                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signup action
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        $this->layout = 'nosidebar';
        $model = new SignupForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup', ['model'=>$model]);
    }

    /**
     * @param $user_id
     * @param $first_name
     * @param $photo
     * @return \yii\web\Response
     */
    public function actionLoginVk($user_id, $first_name, $photo)
    {
        if((new User())->saveFromVk($user_id, $first_name, $photo))
        {
            return $this->redirect(['site/index']);
        }
    }
}