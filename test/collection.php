<?php
require_once "../ruby.php";
class CollectionTest extends PHPUnit_Framework_TestCase {
    public function testCollect()
    {
        $a = array(1, 2, 3);  
        $b = Ruby::collect($a,function($i){return $i*2;});
        $this->assertEquals($b, array(2,4,6));
    }

    public function testSelect()
    {
        $a = array(1, 2, 3);  
        $b = Ruby::select($a,function($i){return ($i%2 == 0);});
        $this->assertEquals($b, array(2));
    }

    public function testAnyFalse()
    {
        $a = array(1);  
        $b = Ruby::any($a,function($i){return $i == 2;});
        $this->assertEquals($b, false);
    }

    public function testAnyTrue()
    {
        $a = array(1, 2);
        $b = Ruby::any($a,function($i){return $i == 2;});
        $this->assertEquals($b, true);
    }

    public function testAllFalse()
    {
        $a = array(1, 2, 3);  
        $b = Ruby::all($a,function($i){return ($i%2 == 0);});
        $this->assertEquals($b, false);
    }

    public function testAllTrue()
    {
        $a = array(2, 4, 6);  
        $check = 3;
        $b = Ruby::all($a,function($i){return ($i%2 == 0);});
        $this->assertEquals($b, true);
    }

    public function testReject()
    {
        $a = array(1, 2, 3);  
        $b = Ruby::reject($a,function($i){return ($i%2 == 0);});
        $this->assertEquals($b, array(1,3));
    }

    public function testInject()
    {
        $a = array(1, 2, 3);
        $x  = 0;
        $b = Ruby::inject($a, $x, function($x, $i){return $x += $i;});
        $this->assertEquals($b, 6);
    }

    public function testReduce()
    {
        $a = array(1, 2, 3);
        $b = Ruby::reduce($a, 0, function($x, $i){return $x += $i;});
        $this->assertEquals($b, 6);
    }

    public function testInjectWithIndex()
    {
        $a = array(1, 2, 3);
        $b = Ruby::inject_with_index($a, 0, function($x, $i, $y){return $x += ($i + $y);});
        $this->assertEquals($b, 9);
    }

    public function testCompact()
    {
        $a = array(1, NULL, 2, NULL, 3);
        $b = Ruby::compact($a);
        $this->assertEquals($b, array(1,2,3));
    }

    public function testJoin()
    {
        $a = array("I", "are", "string");
        $b = Ruby::join($a, " ");
        $this->assertEquals($b, "I are string");
    }
}
?>
