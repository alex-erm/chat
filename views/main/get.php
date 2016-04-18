<?php

    foreach ($modelArhiv as $message){
        echo "<p>";
        echo '<span class="user-date">' . $message['create_at'] . '</span><br>';
        echo $message['user_id']===2 ? ( '<span class="user">Гость('. $message['user_name'] . '): </span>'):('<span class="user">' . $message['user_name'] . ': </span>');
        echo $message['message'];
        echo "</p>";
    }
?>
