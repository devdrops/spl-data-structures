<?php

/**
 * Number of times to run through each benchmark to produce an average.
 */
define("TRIALS", 30);

define("SMALL",     [1 <<  9, 1 << 14]);
define("MEDIUM",    [1 << 15, 1 << 20]);
define("LARGE",     [1 << 19, 1 << 24]);

/**
 * The number of samples to take during the benchmark.
 */
define("SAMPLES", 1000);


/**
 * Determines the type of benchmark.
 */
define("INCREMENTAL", 0);
define("EXPONENTIAL", 1);

/**
 *
 */
define("PHP_ARRAY",         "PHP array");
define("SPL_DLL",           "SplDoublyLinkedList");
define("SPL_STACK",         "SplStack");
define("SPL_QUEUE",         "SplQueue");
define("SPL_OS",            "SplObjectStorage");
define("SPL_PQ",            "SplPriorityQueue");
define("SPL_FA",            "SplFixedArray");

$a = null; // array or collection

/**
 * Benchmarking task configuration.
 */
return [
    'ADD' => [ INCREMENTAL, [
        PHP_ARRAY => [
            function($n) { global $a; $a = []; },
            function($i) { global $a; array_push($a, rand()); },
            function() { global $a; $a = null; },
        ],
        SPL_DLL => [
            function($n) { global $a; $a = new SplDoublyLinkedList(); },
            function($i) { global $a; $a->push(rand()); },
            function() { global $a; $a = null; },
        ],
        SPL_STACK => [
            function($n) { global $a; $a = new SplStack(); },
            function($i) { global $a; $a->push(rand()); },
            function() { global $a; $a = null; },
        ],
        SPL_QUEUE => [
            function($n) { global $a; $a = new SplQueue(); },
            function($i) { global $a; $a->push(rand()); },
            function() { global $a; $a = null; },
        ],
        SPL_PQ => [
            function($n) { global $a; $a = new SplPriorityQueue(); },
            function($i) { global $a; $a->insert(rand(), rand());  },
            function() { global $a; $a = null; },
        ],
        SPL_FA => [
            function($n) { global $a; $a = new SplFixedArray($n); },
            function($i) { global $a; $a[$i] = rand(); },
            function() { global $a; $a = null; },
        ],
        SPL_OS => [
            function($n) { global $a; $a = new SplObjectStorage(); },
            function($i) { global $a; $a->attach(new stdClass()); },
            function() { global $a; $a = null; },
        ],
    ]],

    'DROP' => [INCREMENTAL, [
        PHP_ARRAY => [
            function($n) { global $a; $a = []; for (; $n--; $a[] = rand()); },
            function($i) { global $a; array_pop($a); },
            function()   { global $a; $a = null; },
        ],
        SPL_DLL => [
            function($n) { global $a; $a = new \SplDoublyLinkedList(); for (; $n--; $a[] = rand()); },
            function($i) { global $a; $a->pop(); },
            function() { global $a; $a = null; },
        ],
        SPL_STACK => [
            function($n) { global $a; $a = new SplStack(); for (; $n--; $a[] = rand()); },
            function($i) { global $a; $a->pop(); },
            function()   { global $a; $a = null; },
        ],
        SPL_QUEUE => [
            function($n) { global $a; $a = new SplQueue(); for (; $n--; $a[] = rand()); },
            function($i) { global $a; $a->pop(); },
            function()   { global $a; $a = null; },
        ],
        SPL_PQ => [
            function($n) { global $a; $a = new SplPriorityQueue(); for (; $n--; $a->insert(rand(), rand())); },
            function($i) { global $a; $a->extract(); },
            function()   { global $a; $a = null; },
        ],
        SPL_FA => [
            function($n) { global $a; $a = new SplFixedArray($n); for (; $n--; $a[$n] = rand()); },
            function($i) { global $a; unset($a[$i]); },
            function()   { global $a; $a = null; },
        ],
    ]],
];
