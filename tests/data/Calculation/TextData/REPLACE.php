<?php

return [
    [
        'QWDFGYUIOP',
        'QWERTYUIOP',
        3,
        3,
        'DFG',
    ],
    [
        'QWERDFGIOP',
        'QWERTYUIOP',
        5,
        3,
        'DFG',
    ],
    [
        'QWDFGERTYUIOP',
        'QWERTYUIOP',
        3,
        0,
        'DFG',
    ],
    [
        'QWERDFGTYUIOP',
        'QWERTYUIOP',
        5,
        0,
        'DFG',
    ],
    [
        'Ενα δύοτρίατέσσεραπέντε',
        'Εναδύοτρίατέσσεραπέντε',
        4,
        0,
        ' ',
    ],
    [
        'Ενα δύο τρίατέσσεραπέντε',
        'Ενα δύοτρίατέσσεραπέντε',
        8,
        0,
        ' ',
    ],
    [
        'Ενα δύο τρία τέσσεραπέντε',
        'Ενα δύο τρίατέσσεραπέντε',
        13,
        0,
        ' ',
    ],
    [
        'Ενα δύο τρία τέσσερα πέντε',
        'Ενα δύο τρία τέσσεραπέντε',
        21,
        0,
        ' ',
    ],
    'no arguments' => ['exception'],
    'one argument' => ['exception', 'hello'],
    'two arguments' => ['exception', 'hello', 2],
    'three arguments' => ['exception', 'hello', 2, 2],
    'position zero' => ['#VALUE!', 'hello', 0, 2, 'xyz'],
    'negative length' => ['#VALUE!', 'hello', 3, -1, 'xyz'],
    'boolean 1st parm' => ['TRDFGE', true, 3, 1, 'DFG'],
    'boolean 4th parm' => ['heFALSElo', 'hello', 3, 1, false],
    'propagate REF' => ['#REF!', '=sheet99!A1', 3, 1, 'x'],
    'propagate DIV0' => ['#DIV/0!', '=1/0', 3, 1, 'x'],
    'string which just sneaks in' => [
        str_repeat('A', 32766) . 'C',
        str_repeat('A', 32766) . 'B',
        32767,
        '1',
        'C',
    ],
    'string which overflows' => [
        '#VALUE!',
        str_repeat('A', 32766) . 'B',
        32767,
        '1',
        'CC',
    ],
];
