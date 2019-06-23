<?php
use vision\messages\widgets\CloadMessage;


echo CloadMessage::widget();
?>
    <script>
        var listener = new privateMessPooling();
        listener.addListener('newData', function(result){
            console.log(result);
        });
        listener.start();
    </script>