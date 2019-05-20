<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\User;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * Login action
     *
     * @return string|Response
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
     * @return string|Response
     * @throws Exception
     */
    public function actionSignup()
    {
        $this->layout = 'nosidebar';
        $model = new SignupForm();
        $model->load(Yii::$app->request->post(), '');

        if(Yii::$app->request->isPost)
        {
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
     * @return Response
     */
    public function actionLoginVk($user_id, $first_name, $photo)
    {
        if((new User())->saveFromVk($user_id, $first_name, $photo))
        {
            return $this->redirect(['site/index']);
        }
    }
}