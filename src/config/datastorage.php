<?php
/**
 * The Standard Internation DataStorage unit
 *
 * Data storage is the recording (storing) of information in a storage medium. DNA and RNA, handwriting, phonographic recording, magnetic tape, and optical discs are all examples of storage media. Recording is accomplished by virtually any form of energy. Electronic data storage requires electrical power to store and retrieve data.
 *
 * @author Kevin Farias <kevin.farias.dev@gmail.com>
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Volumne Formulas
    |--------------------------------------------------------------------------
    |
    | These values represent the convertion of each unit and the base SI Unit.
    |
    */

    'aliases' => [
        'bytes' => 'B',
        'kilobits' => 'Kb',
        'kilobytes' => 'KB',
        'megabits' => 'Mb',
        'megabytes' => 'MB',
        'gigabits' => 'Gb',
        'gigabytes' => 'GB',
        'terabits' => 'Tb',
        'terabytes' => 'TB',
        'petabits' => 'Pb',
        'petabytes' => 'PB',
        'exabits' => 'Eb',
        'exabytes' => 'EB',
        'zettabits' => 'Zb',
        'zettabytes' => 'ZB',
        'yottabits' => 'Yb',
        'yottabytes' => 'YB',
    ],

    /*
    |--------------------------------------------------------------------------
    | Volume Formulas
    |--------------------------------------------------------------------------
    |
    | These values represent the convertion of each unit and the base SI Unit.
    |
    */

    'formulas' => [
        // si unit is mb
        // units for network (2014)
        'kb' => 0.0009765625,
        'KB' => 0.0009765625,
        'mb' => 1, // SI Unit
        'MB' => 1,
        'gb' => 1024,
        'GB' => 1024,
        'tb' => 1048576,
        'TB' => 1048576,
        'pb' => 1073741824,
        'PB' => 1073741824,
        'eb' => 1099511627776,
        'EB' => 1099511627776,
        'zb' => 1125899906842624,
        'ZB' => 1125899906842624,
        'yb' => 1152921504606846976,
        'YB' => 1152921504606846976,
    ],
];
