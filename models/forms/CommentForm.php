<?php
declare(strict_types=1);

namespace app\models\forms;

use app\models\Comment;
use Yii;
use yii\base\Model;

/**
 * Class CommentForm
 * @package app\models\forms
 */
class CommentForm extends Model
{
    /**
     * @var Comment $comment
     */
    public $comment;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    /**
     * @param $article_id
     * @return bool
     */
    public function saveComment($article_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = Comment::STATUS_DISALLOW;

        return $comment->save();
    }
}