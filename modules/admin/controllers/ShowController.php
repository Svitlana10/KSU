<?php

namespace app\modules\admin\controllers;

use app\models\forms\ShowForm;
use app\models\searchs\DogShowSearch;
use Yii;
use app\models\Show;
use app\models\searchs\ShowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShowController implements the CRUD actions for Show model.
 */
class ShowController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Show models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Show model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /** @var Show $model */
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'dogs' => $model->dogs
        ]);
    }

    /**
     * Creates a new Show model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new ShowForm();

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->img = UploadedFile::getInstance($model, 'img') ?: UploadedFile::getInstanceByName('img');
            if ($model->create()) {

                return $this->redirect(['view', 'id' => $model->show->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DogShow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = new ShowForm(['show' => $this->findModel($id)]);

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->img = UploadedFile::getInstance($model, 'img') ?: UploadedFile::getInstanceByName('img');
            if ($model->update()) {

                return $this->redirect(['view', 'id' => $model->show->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Show model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Show model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Show the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Show::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
