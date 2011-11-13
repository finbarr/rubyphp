Ruby functions for PHP
======================

$a = array(1,2,3);
$b = Ruby::map($a,function($i){return $i*2;});
$b == array(2,4,6); // TRUE
