<?php
declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\models\Comment;
use Throwable;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class CommentController
 * @package app\modules\admin\controllers
 */
class CommentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('id desc')->all();

        return $this->render('index', ['comments' => $comments]);
    }

    /**
     * @param $id
     * @return Response
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if ($comment && $comment->delete()) {
            return $this->redirect(['comment/index']);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment && $comment->allow()) {
            return $this->redirect(['index']);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);
        if ($comment && $comment->disallow()) {
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}