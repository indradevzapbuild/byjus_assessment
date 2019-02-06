<?php
require_once 'math/Calculator.php';

$cal = new Calculator();

$answer = $cal->evaluate('((2*3) +4/ (5*2))*4');
var_dump($answer);



 ?>