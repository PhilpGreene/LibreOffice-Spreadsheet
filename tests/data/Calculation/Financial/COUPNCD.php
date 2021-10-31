<?php

// Settlement, Maturity, Frequency, Basis, Result

return [
    [
        39217,
        '25-Jan-2007',
        '15-Nov-2008',
        2,
        1,
    ],
    [
        40568,
        '2011-01-01',
        '2012-10-25',
        4,
    ],
    [
        40568,
        '2011-01-01',
        '2012-10-25',
        4,
        null,
    ],
    [
        '#VALUE!',
        'Invalid Date',
        '15-Nov-2008',
        2,
        1,
    ],
    [
        '#VALUE!',
        '25-Jan-2007',
        'Invalid Date',
        2,
        1,
    ],
    'Invalid Frequency' => [
        '#NUM!',
        '25-Jan-2007',
        '15-Nov-2008',
        3,
        1,
    ],
    'Non-Numeric Frequency' => [
        '#VALUE!',
        '25-Jan-2007',
        '15-Nov-2008',
        'NaN',
        1,
    ],
    'Invalid Basis' => [
        '#NUM!',
        '25-Jan-2007',
        '15-Nov-2008',
        4,
        -1,
    ],
    'Non-Numeric Basis' => [
        '#VALUE!',
        '25-Jan-2007',
        '15-Nov-2008',
        4,
        'NaN',
    ],
    'Same Date' => [
        '#NUM!',
        '24-Dec-2000',
        '24-Dec-2000',
        4,
        0,
    ],
    [
        36884,
        '23-Dec-2000',
        '24-Dec-2000',
        4,
        0,
    ],
    [
        36884,
        '24-Sep-2000',
        '24-Dec-2000',
        4,
        0,
    ],
    [
        36793,
        '23-Sep-2000',
        '24-Dec-2000',
        4,
        0,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        1,
        0,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        1,
        1,
    ],
    [
        43910,
        '31-Jan-2020',
        '20-Mar-2021',
        1,
        1,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        1,
        2,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        1,
        3,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        1,
        4,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        2,
        0,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        2,
        1,
    ],
    [
        43910,
        '31-Jan-2020',
        '20-Mar-2021',
        2,
        1,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        2,
        2,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        2,
        3,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        2,
        4,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        4,
        0,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        4,
        1,
    ],
    [
        43910,
        '31-Jan-2020',
        '20-Mar-2021',
        4,
        1,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        4,
        2,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        4,
        3,
    ],
    [
        44275,
        '31-Jan-2021',
        '20-Mar-2021',
        4,
        4,
    ],
    [
        44651,
        '30-Sep-2021',
        '31-Mar-2022',
        2,
        0,
    ],
    [
        44834,
        '31-Mar-2022',
        '30-Sep-2022',
        2,
        0,
    ],
    [
        43738,
        '05-Apr-2019',
        '30-Sep-2021',
        2,
        0,
    ],
    [
        43921,
        '05-Oct-2019',
        '31-Mar-2022',
        2,
        0,
    ],
];
