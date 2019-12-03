<?php
$quiz_list_show = array();

function print_quiz(){
    global $quiz_list_show;
    print_r($quiz_list_show);
}
function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

?>