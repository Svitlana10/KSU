<?php use app\models\Article;
use app\models\Comment;
use app\models\forms\CommentForm;
use yii\widgets\ActiveForm;

if(!empty($comments)):?>

    <?php
    /** @var Comment $comment */
    foreach($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <img width="50" class="img-circle" src="<?= $comment->user->image; ?>" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> </a>
                <h5><?= $comment->user->username;?></h5>

                <p class="comment-date">
                    <?= $comment->date ?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php endforeach;?>

<?php endif;?>
<!-- end bottom comment-->

<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->

        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php
        /** @var Article $article */
        /** @var CommentForm $commentForm */
        $form = ActiveForm::begin([
            'action'=>['site/comment', 'id'=>$article->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <button type="submit" class="button_1">Опублікувати </button>
        <?php ActiveForm::end();?>
    </div><!--end leave comment-->
<?php endif;?>
