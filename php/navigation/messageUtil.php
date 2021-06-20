<?php

function showMessage($message, $deep=false){
    echo '<div id="myModal" class="modal">';
    echo '<div class="modal-content">';
    echo '<span id="closeModal" class="close">&times;</span>';
    echo '<p>' . $message . '</p>';
    echo '</div>';
    echo '</div>';
    calljs($deep);
}

function calljs($deep){
    echo '<script type="text/javascript" src="';
    if($deep)
        echo '../';
    echo '../js/effects/messagePopup.js"></script>';
}


