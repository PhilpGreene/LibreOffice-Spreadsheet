<?php

return [
    [
        64,
        [5, 2, 3],
        [3, -1, 4],
    ],
    [
        521,
        [2, 3, 9, 1, 8, 7, 5],
        [6, 5, 11, 7, 5, 4, 4],
    ],
    [
        204,
        [[1, 2], [3, 4]],
        [[5, 6], [7, 8]],
    ],
    [30, [1, 2], [3, 4]],
    [30, [1, '=2'], [3, 4]],
    [10, [1, ''], [3, 4]],
    [10, [1, '2'], [3, 4]],
    [10, [1, '="2"'], [3, 4]],
    [10, [1, 'X'], [3, 4]],
    [10, [1, false], [3, 4]],
    [20, [1, 2], [null, 4]],
    [20, [1, 2], [true, 4]],
    ['#N/A', [1, 2], [3, 4, 5]], // different dimensions
];
