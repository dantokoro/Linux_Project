<?php

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function answer_color($chosen, $right, $this_answer){      //($_POST["answer"], $question["answer"], "a" )
    if(strcmp($this_answer, $right)==0) echo 'style="background-color:#32CD32"';
    if(strcmp($chosen, $this_answer)==0) echo 'style="background-color:#FF0000"';
    echo 'style="background-color:rgb(189, 176, 98)"';
}
?>