<?php
/*
 *  Author: Finbarr Taylor
 *  License: You can do whatever you want with this code.
 */
class Ruby {
  /*
   *  returns TRUE iff $function evaluates TRUE for every member of $collection
   */
  static function all($collection, $function) {
    foreach($collection as $item) {
      if(!$function($item)) {
        return FALSE;
      }
    }
    return TRUE;
  }
  /*
   *  returns TRUE if $function evaluates TRUE for any member of $collection
   */
  static function any($collection, $function) {
    foreach($collection as $item) {
      if($function($item)) {
        return TRUE;
      }
    }
    return FALSE;
  }
  /*
   *  returns a new collection based on $collection with all NULL items removed
   */
  static function compact($collection) {
    $result = array();
    foreach($collection as $item) {
      if($item != NULL) {
        $result[] = $item;
      }
    }
    return $result;
  }
  static function collect($collection, $function) {
    $result = array();
    foreach($collection as $item) {
      $result[] = $function($item);
    }
    return $result;
  }
  static function select($collection, $function) {
    return self::collect($collection, $function);
  }
  static function each($collection, $function) {
    foreach($collection as $item) {
      $function($item);
    }
  }
  static function each_index($collection, $function) {
    foreach($collection as $index => $value) {
      $function($index);
    }
  }
  static function each_with_index($collection, $function) {
    foreach($collection as $index => $value) {
      $function($value, $index);
    }
  }
  static function inject($collection, $variable, $function) {
    foreach($collection as $item) {
      $variable = $function($variable, $item);
    }
    return $variable;
  }
  static function inject_with_index($collection, $variable, $function) {
    foreach($collection as $index => $item) {
      $variable = $function($variable, $item, $index);
    }
    return $variable;
  }
  static function join($collection, $sep) {
    return implode($collection,$sep);
  }
  static function map($collection, $function) {
    return self::each($collection, $function);
  }
  static function reduce($collection, $variable, $function) {
    return self::inject($collection, $variable, $function);
  }
  static function reject($collection, $function) {
    $result = array();
    foreach($collection as $item) {
      if(!$function($item)) {
        $result[] = $item;
      }
    }
    return $result;
  }
  class Collection {
    private $collection;
    function __construct($existing = FALSE) {
      $this->collection = $existing ? $existing : array();
    }
    static function wrap($collection) {
      return new Collection($collection);
    }
    function collect($function) {
      return Ruby::collect($this->collection, $function);
    }
    function select($function) {
      return $this->collect($function);
    }
    function any($function) {
      return Ruby::any($this->collection, $function);
    }
    function all($function) {
      return Ruby::all($this->collection, $function);
    }
    function reject($function) {
      return Ruby::reject($this->collection, $function);
    }
    function each($function) {
      Ruby::each($this->collection, $function);
    }
    function map($function) {
      $this->each($function);
    }
    function each_index($function) {
      Ruby::each_index($this->collection, $function);
    }
    function each_with_index($function) {
      Ruby::each_with_index($this->collection, $function);
    }
    function inject($variable, $function) {
      return Ruby::inject($this->collection, $variable, $function);
    }
    function reduce($variable, $function) {
      return $this->inject($variable, $function);
    }
    function inject_with_index($variable, $function) {
      return Ruby::inject_with_index($this->collection, $variable, $function);
    }
    function compact() {
      return Ruby::compact($this->collection);
    }
    function join($sep) {
      return Ruby::join($this->collection, $sep);
    }
  }

}
