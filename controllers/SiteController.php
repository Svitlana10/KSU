<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\forms\CommentForm;
use app\models\forms\DogShowForm;
use app\models\searchs\ArticleSearch;
use app\models\Show;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'comment'],
                'rules' => [
                    [
                        'actions' => ['logout', 'comment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'nosidebar',
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
        $dataProvider = (new ArticleSearch())->search(Yii::$app->request->queryParams, 3);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $comments = $article->getArticleComments();
        $commentForm = new CommentForm();

        $article->viewedCounter();

        return $this->render('single',[
            'article'=>$article,
            'comments'=>$comments,
            'commentForm'=>$commentForm
        ]);
    }

    /**
     * @param $id
     * @return CommentForm|Response
     */
    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view','id'=>$id]);
            }
        }
    }

    /**
     * @param $show
     * @return string
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionRegisterDog($show)
    {
        $model = new DogShowForm(['show' => $this->findShow($show)]);
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->create()){

                Yii::$app->getSession()->setFlash('comment', 'Перевірте вашу поштову скриньку');
                return $this->redirect(['/'])->send();
            }
        }

        return $this->render('register-dog',[
            'model'=>$model,
        ]);
    }

    /**
     * @param $show_id
     * @return Show
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    protected function findShow($show_id)
    {
        /** @var Show $model */
        if($model = Show::findOne(['id' => $show_id])){
            if(!$model->startRegStatus){
                throw new BadRequestHttpException('Реєстрація ще не розпочалась');
            } elseif (!$model->finishRegStatus) {
                throw new BadRequestHttpException('Реєстрація вже закінчилась');
            } else {
                return $model;
            }
        } else {
            throw  new NotFoundHttpException('Такої виставки не існує');
        }
    }
}
