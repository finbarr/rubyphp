<?php
/*
 *  Author: Finbarr Taylor
 *  License: You can do whatever you want with this code.
 */
class Ruby {

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
  static function any($collection, $function) {
    foreach($collection as $item) {
      if($function($item)) {
        return TRUE;
      }
    }
    return FALSE;
  }
  static function all($collection, $function) {
    foreach($collection as $item) {
      if(!$function($item)) {
        return FALSE;
      }
    }
    return TRUE;
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
  static function each($collection, $function) {
    foreach($collection as $item) {
      $function($item);
    }
  }
  static function map($collection, $function) {
    return self::each($collection, $function);
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
  static function reduce($collection, $variable, $function) {
    return self::inject($collection, $variable, $function);
  }
  static function inject_with_index($collection, $variable, $function) {
    foreach($collection as $index => $item) {
      $variable = $function($variable, $item, $index);
    }
    return $variable;
  }
  static function compact($collection) {
    $result = array();
    foreach($collection as $item) {
      if($item != NULL) {
        $result[] = $item;
      }
    }
    return $result;
  }
  static function join($collection, $sep) {
    return implode($collection,$sep);
  }

}
