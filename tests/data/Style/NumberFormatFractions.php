<?php

//  value, format, result

return [
    // Fraction
    [
        '5 1/4',
        5.25,
        '# ???/???',
    ],
    [
        '5 3/10',
        5.2999999999999998,
        '# ???/???',
    ],
    // Vulgar Fraction
    [
        '21/4',
        5.25,
        '???/???',
    ],
    [
        '0 3/4',
        0.75,
        '0??/???',
    ],
    [
        '3/4',
        0.75,
        '#??/???',
    ],
    [
        ' 3/4',
        0.75,
        '? ??/???',
    ],
    [
        ' 3/4',
        '0.75000',
        '? ??/???',
    ],
    [
        '5 1/16',
        5.0625,
        '? ??/???',
    ],
    [
        '- 5/8',
        -0.625,
        '? ??/???',
    ],
    [
        '0',
        0,
        '? ??/???',
    ],
    [
        '0',
        '0.000',
        '? ??/???',
    ],
    [
        '-16',
        '-016.0',
        '? ??/???',
    ],
    // Fixed base Fraction
    [
        '5 1/2',
        5.25,
        '# ???/2',
    ],
    [
        '5 1/4',
        5.25,
        '# ???/4',
    ],
    [
        '5 2/8',
        5.25,
        '# ???/8',
    ],
    [
        '5 3/10',
        5.25,
        '# ???/10',
    ],
    [
        '5 25/100',
        5.25,
        '# ???/100',
    ],
    [
        '525/100',
        5.25,
        '??/100',
    ],
    [
        '525/100',
        5.25,
        '???/100',
    ],
    [
        '2 2/3',
        2.65,
        '# ???/3',
    ],
    [
        '2 3/4',
        2.65,
        '# ???/4',
    ],
    [
        '2 4/6',
        2.65,
        '# ???/6',
    ],
    [
        '2 8/12',
        2.65,
        '# ???/12',
    ],
];
