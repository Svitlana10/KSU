<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Article;
use app\models\forms\CommentForm;
use app\models\forms\RegisterForm;
use app\models\searchs\ArticleSearch;
use app\models\Show;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use vision\messages\actions\MessageApiAction;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class SiteController
 * @package app\controllers
 */
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
                'only' => ['logout', 'comment', 'messenger'],
                'rules' => [
                    [
                        'actions' => ['logout', 'comment', 'messenger'],
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
            'private-messages' => [
                'class' => MessageApiAction::class
            ]
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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);

        if ($article == null) {
            throw new NotFoundHttpException('Подія не знайдена');
        }

        $comments = $article->getArticleComments();
        $commentForm = new CommentForm();

        $article->viewedCounter();

        return $this->render('single', [
            'article' => $article,
            'comments' => $comments,
            'commentForm' => $commentForm
        ]);
    }

    /**
     * @param $id
     * @return CommentForm|Response
     */
    public function actionComment($id)
    {
        $model = new CommentForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->saveComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
            } else {
                Yii::$app->getSession()->setFlash('comment', 'Щось пішло не так, спробуйте пізніше');
            }
        }

        return $this->redirect(['site/view', 'id' => $id]);
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
        $this->layout = 'nosidebar';
        $model = new RegisterForm(['show' => $this->findShow($show)]);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->dog->load(Yii::$app->request->post());
            if ($model->create()) {
                Yii::$app->getSession()->setFlash('comment', 'Перевірте вашу поштову скриньку');
                return $this->redirect(['/'])->send();
            } else {
                Yii::$app->getSession()->setFlash('comment', 'Щось пішло не так, спробуйте пізніше');
            }
        }

        return $this->render('register-dog', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionMessenger()
    {
        $this->layout = 'nosidebar';
        return $this->render('messenger');
    }

    /**
     * @param $id
     * @return mixed
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     * @throws MpdfException
     * @throws CrossReferenceException
     * @throws PdfParserException
     * @throws PdfTypeException
     */
    public function actionViewDog($id)
    {
        $model = Show::findOne($id);

        if ($model === null) {
            throw new BadRequestHttpException();
        }

        $this->layout = 'pdf';

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'content' => $this->render('viewpdf', ['model' => $model]),
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '',
            'options' => [
                'title' => $model->title,
                'subject' => 'PDF'
            ],
            'methods' => [
                'SetHeader' => ['Khmelnytsky vistavka'],
                'SetFooter' => ['|{PAGENO}|'],
            ]
        ]);
        return $pdf->render();
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
        if ($model = Show::findOne(['id' => $show_id])) {
            if (!$model->startRegStatus) {
                throw new BadRequestHttpException('Реєстрація ще не розпочалась');
            } elseif (!$model->finishRegStatus) {
                throw new BadRequestHttpException('Реєстрація вже закінчилась');
            } else {
                return $model;
            }
        } else {
            throw new NotFoundHttpException('Такої виставки не існує');
        }
    }
}
