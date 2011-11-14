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
  /*
   *  returns a new collection based on values returned by evaluating $function
   *  on each item in $collection
   */
  static function collect($collection, $function) {
    $result = array();
    foreach($collection as $item) {
      $result[] = $function($item);
    }
    return $result;
  }
  /*
   *  returns a new Ruby::Collection
   */
  static function collection() {
    return new Collection();
  }
  /*
   *  evaluates $function on each item in $collection
   */
  static function each($collection, $function) {
    foreach($collection as $item) {
      $function($item);
    }
  }
  /*
   *  evaluates $function on each index in $collection
   */
  static function each_index($collection, $function) {
    foreach($collection as $index => $value) {
      $function($index);
    }
  }
  /*
   *  evaluates $function on each item and index in $collection
   */
  static function each_with_index($collection, $function) {
    foreach($collection as $index => $item) {
      $function($item, $index);
    }
  }
  /*
   *  evaluates $function on each item in $collection and the last
   *  value returned from $function (initially the passed $variable)
   */
  static function inject($collection, $variable, $function) {
    foreach($collection as $item) {
      $variable = $function($variable, $item);
    }
    return $variable;
  }
  /*
   *  like Ruby::inject including the index of the item
   */
  static function inject_with_index($collection, $variable, $function) {
    foreach($collection as $index => $item) {
      $variable = $function($variable, $item, $index);
    }
    return $variable;
  }
  static function join($collection, $sep) {
    return implode($collection, $sep);
  }
  /*
   *  see Ruby::collect
   */
  static function map($collection, $function) {
    return self::collect($collection, $function);
  }
  /*
   *  see Ruby::inject
   */
  static function reduce($collection, $variable, $function) {
    return self::inject($collection, $variable, $function);
  }
  /*
   *  returns a new collection based on items in $collection for which
   *  $function evaluates to FALSE
   */
  static function reject($collection, $function) {
    $result = array();
    foreach($collection as $item) {
      if(!$function($item)) {
        $result[] = $item;
      }
    }
    return $result;
  }
  /*
   *  returns a new collection based on items in $collection for which
   *  $function evaluates to TRUE
   */
  static function select($collection, $function) {
    $result = array();
    foreach($collection as $item) {
      if($function($item)) {
        $result[] = $item;
      }
    }
    return $result;
  }
  /*
   *  wraps an existing collection in a Ruby::Collection
   */
  static function wrap($collection) {
    return new Collection($collection);
  }
  class Collection {
    private $collection;
    function __construct($existing = FALSE) {
      $this->collection = $existing ? $existing : array();
    }
    function all($function) {
      return Ruby::all($this->collection, $function);
    }
    function any($function) {
      return Ruby::any($this->collection, $function);
    }
    function collect($function) {
      return Ruby::collect($this->collection, $function);
    }
    function compact() {
      return Ruby::compact($this->collection);
    }
    function each($function) {
      Ruby::each($this->collection, $function);
    }
    function each_index($function) {
      Ruby::each_index($this->collection, $function);
    }
    function each_with_index($function) {
      Ruby::each_with_index($this->collection, $function);
    }
    function empty() {
      return count($this->collection) === 0;
    }
    function fetch($index) {
      return $this->collection[$index];
    }
    function inject($variable, $function) {
      return Ruby::inject($this->collection, $variable, $function);
    }
    function inject_with_index($variable, $function) {
      return Ruby::inject_with_index($this->collection, $variable, $function);
    }
    function join($sep) {
      return Ruby::join($this->collection, $sep);
    }
    function map($function) {
      $this->collect($function);
    }
    function reduce($variable, $function) {
      return $this->inject($variable, $function);
    }
    function reject($function) {
      return Ruby::reject($this->collection, $function);
    }
    function select($function) {
      return Ruby::select($this->collection, $function);
    }
    function unwrap() {
      return $this->collection;
    }
  }

}
