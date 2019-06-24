<?php

namespace app\modules\admin\controllers;

use app\models\Dog;
use app\models\DogBreeds;
use app\models\searchs\DogSearch;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * DogController implements the CRUD actions for Dog model.
 */
class DogController extends Controller
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
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'view', 'delete', 'document', 'create-document-pedigree'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'document', 'create-document-pedigree'],
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all Dog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DogSearch();
        $searchModel->load(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Dog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Dog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dog();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->breed_id = $this->checkDogBreed($model->breed_title);
            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $breed_title
     * @return bool
     */
    protected function checkDogBreed($breed_title)
    {
        $breed = DogBreeds::find()->where(['like', 'title', $breed_title])->one();

        if (!$breed) {
            $breed = new DogBreeds();
            $breed->title = $breed_title;
            $breed->status = DogBreeds::STATUS_NEW;

            if (!$breed->save()) {

                return 1;
            }
        }

        return $breed->id;
    }

    public function actionDoc()
    {

    }

    /**
     * Updates an existing Dog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->breed_id = $this->checkDogBreed($model->breed_title);
            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function actionDocument()
    {
        $phpWord = new PhpWord();
        $dogs = Dog::find()->all();
        $section = $phpWord->addSection();
        /** @var Dog $dog */
        foreach ($dogs as $dog) {
            $section->addText("Ім'я: $dog->dog_name; власник: $dog->owner; порода: ".$dog->breed->title,
                ['name' => 'Times New Roman', 'size' => 14]);
        }
        $objWriter = IOFactory::createWriter($phpWord);
        $objWriter->save( 'document.docx');

        return $this->goBack('/admin');
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function actionCreateDocumentPedigree()
    {
        $phpWord = new PhpWord();
        $dogs = Dog::find()->all();
        $section = $phpWord->addSection();
        $section->addText('В цьому місцяці народились', ['name' => 'Times New Roman', 'size' => 14, 'bold' => true]);
        /** @var Dog $dog */
        foreach ($dogs as $dog) {
            if($dog->born_month === date('m', time())) {
                $section->addText("Ім'я: $dog->dog_name; власник: $dog->owner; дата народження: ".date('Y-m-d', $dog->born_at),
                    ['name' => 'Times New Roman', 'size' => 14]);
            }
        }
        $section->addText('Голова осередку Віктор Болячко', ['name' => 'Times New Roman', 'size' => 14, 'bold' => true]);
        $objWriter = IOFactory::createWriter($phpWord);
        $objWriter->save( 'document_pedigree.docx');

        return $this->goBack('/admin');
    }

    /**
     * Deletes an existing Dog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
