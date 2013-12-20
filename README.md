Ruby functions for PHP
======================

After working with Ruby full time for over a month, I went back to a PHP project and decided something was missing...

This project aims to port some of the lovely ruby methods for working with arrays and hashes to PHP.

Sneak preview
=============

```php
$myArray = Ruby::wrap(array(1,2,3));
$sum = $myArray->inject(0, function($sum,$i){return $sum + $i});
echo $sum; // prints 6
```

There are implementations for many of the common methods - scroll down to see examples.

Using the code
==============

There are two ways to use the code: you can treat it as a set of helper methods or as an array wrapper.

Helper method style
===================

```php
Ruby::method($myArray, function($args){ #evaluate });
```

Array wrapper style
===================

```php
$a = Ruby::collection();
# or
$a = Ruby::wrap($myArray);
# both
$a->method(function($args){ #evaluate });
```

Which should I use?
===================

The Helper method style is a little more verbose but maintains your direct access to the array:

```php
$myArray['someKey'];
```

The Array wrapper style is neater but more verbose for array access:

```php
$myArray->fetch('someKey');
# or
$myArray->unwrap()['someKey'];
```

Implemented functionality
=========================

The following examples assume a wrapped php array containing the values 1,2,3

```php
$a = Ruby::wrap(array(1,2,3));
```

all
===

```php
$a->all(function($i){return is_number($i)}); // TRUE
```

any
===

```php
$a->any(function($i){return $i==1;}); // TRUE
```

compact
=======

```php
$a->push(NULL); // [1,2,3,NULL]
$a->compact(); // [1,2,3]
```

collect/map
==============

```php
$a->collect(function($i){return $i*2;}); // [2,4,6]
```

each
====

```php
$a->each(function($i){echo $i;}); // prints 1 2 3
```

each_with_index
===============

```php
$a->each_with_index(function($i,$d){echo $i + $d;}) // prints 1 3 5
```

inject/reduce
=============

```php
$a->inject(0, function($sum,$i){return $sum + $i;}); // 6
```

join
====

```php
$a->join(','); // '1,2,3'
```

reject
======

```php
$a->reject(function($i){return $i%2==0;}); // [1,3]
```

select
======

```php
$a->select(function($i){return $i%2==0;}); // [2]
```
