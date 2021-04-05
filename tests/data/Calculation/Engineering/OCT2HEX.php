<?php

return [
    ['2EF', '1357'],
    ['A6', '246'],
    ['14E5', '12345'],
    ['0040', '100, 4'],
    ['#NUM!', '123.45'],
    ['0', '0'],
    ['#VALUE!', 'true'],
    ['#VALUE!', 'false'],
    ['#NUM!', '3579'],
    ['FFFFFFFF5B', '7777777533'], // 2's Complement
    ['00108', '410, 5'],
    ['#NUM!', '410, 0'],
    ['#NUM!', '410, -1'],
    ['#NUM!', '410, 14'],
    ['#NUM!', '410, 2'],
    ['108', '410, 3'],
    ['41', 'A2'],
    ['0', 'A3'],
    ['exception', ''],
    ['#NUM!', '"37777777770"'], // too many digits
    ['1FFFFFFF', '"3777777777"'], // highest positive
    ['FFE0000000', '"4000000000"'], // lowest negative
];
