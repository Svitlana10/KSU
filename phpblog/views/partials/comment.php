
<!-- *********  Header  ********** -->
    
    <div id="header">
        <div id="header_in">
        
        <h1><a href="index.html"><b>NINA</b> THEME</a></h1>
        
        <div id="menu_1">
         <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="ourwork.html">Our work</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="contact.html">Contact</a></li>            
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part (slider)  ********** -->
    
        
        <div id="main_part">
            <div id="main_part_in">
        
            <h2>Free minimalistic HTML template</h2>
            
            <p>That’s right, this template is absolutely for free for any personal or commercial project</p>
            
            </div>
            
            
            <div class="button_main">
                <div class="pxline"></div>
                <a href="download.html" class="button_dark">DOWNLOAD</a>
            </div>
            
        </div>


<?php if(!empty($comments)):?>

    <?php foreach($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <img width="50" class="img-circle" src="<?= $comment->user->image; ?>" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Змінити</a>
                <h5><?= $comment->user->name;?></h5>

                <p class="comment-date">
                    <?= $comment->getDate();?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php endforeach;?>

<?php endif;?>
<!-- end bottom comment-->

<?php if(!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>
        <?php if(Yii::$app->session->getFlash('comment')):?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php endif;?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['site/comment', 'id'=>$article->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Опублікувати коментарій</button>
        <?php \yii\widgets\ActiveForm::end();?>
    </div><!--end leave comment-->
<?php endif;?>
