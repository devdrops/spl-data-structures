<?php

/**
 * Benchmark schedule.
 */
return [
    'ADD' => [
        [SMALL, [
            PHP_ARRAY,
            SPL_DLL,
            SPL_STACK,
            SPL_QUEUE,
            SPL_PQ,
            SPL_FA,
            SPL_OS,
        ]]
    ],

    'DROP' => [
        [SMALL, [
            PHP_ARRAY,
            SPL_DLL,
            SPL_STACK,
            SPL_QUEUE,
            SPL_PQ,
            SPL_FA,
        ]]
    ],
];
