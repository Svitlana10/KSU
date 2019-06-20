<?php
use vision\messages\widgets\CloadMessage;
use yii\bootstrap\Modal;

Modal::begin([
    'toggleButton' => [
        'label' => '+',
        'id' => 'fixedbutton',
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