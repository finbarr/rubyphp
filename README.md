Ruby functions for PHP
======================

After working with Ruby full time for over a month, I went back to a PHP project and decided something was missing...

This project aims to port some of the lovely ruby methods for working with arrays and hashes to PHP. 

There are two ways to use the code: you can treat it as a set of helper methods or as an array wrapper.

Helper method style
===================

    Ruby::method($myArray, function($args){ #evaluate });

Array wrapper style
===================

    $a = Ruby::collection();
    # or
    $a = Ruby::wrap($myArray);
    # both
    $a->method(function($args){ #evaluate });

Which should I use?
===================

The Helper method style is a little more verbose but maintains your direct access to the array:

    $myArray['someKey'];

The Array wrapper style is neater but more verbose for array access:

    $myArray->fetch('someKey');
    # or
    $myArray->get()['someKey'];