<?php
use vision\messages\widgets\CloadMessage;
use yii\bootstrap\Modal;

Modal::begin([
    'size' => 'modal-lg',
    'toggleButton' => [
        'label' => '+',
        'id' => 'fixedbutton',
        'tag' => 'button',
        'class' => 'btn btn-success btn-lg btn-custom-lg'],
    'footer' => 'asd',
]);
echo CloadMessage::widget();
?>
    <script>
        var listener = new privateMessPooling();
        listener.addListener('newData', function(result){
            console.log(result);
        });
        listener.start();
    </script>
<?php
Modal::end();
?>