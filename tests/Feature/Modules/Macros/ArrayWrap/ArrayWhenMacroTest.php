<?php

declare(strict_types = 1);

use App\Modules\Macros\ArrayWrap\ArrayWhen;
use Illuminate\Support\Arr;

use function PHPUnit\Framework\assertSame;

beforeEach(fn () => ArrayWhen::enableMacro());

test('it can evaluate cases by conditional', function (array $given, array $expected) {
    $returned = Arr::when($given);
    assertSame($expected, $returned);
})->with([
    'raw value' => [
        ['someOtherKey' => 'someOtherValue'],
        ['someOtherKey' => 'someOtherValue'],
    ],
    'raw array' => [
        ['someOtherArray' => ['some', 'other', 'values']],
        ['someOtherArray' => ['some', 'other', 'values']],
    ],
    'when true' => [
        ['secret' => fn ($when) => $when(true, 'secret-value')],
        ['secret' => 'secret-value'],
    ],
    'when false' => [
        ['secret' => fn ($when) => $when(false, 'secret-value')],
        [],
    ],
    'when false and have the default value' => [
        ['secret' => fn ($when) => $when(false, 'secret-value', 'fallback-value')],
        ['secret' => 'fallback-value'],
    ],
    'mergeWhen true' => [
        [
            fn ($mergeWhen) => $mergeWhen(true, [
                'view' => 'all',
                'edit' => 'owned',
            ]),
        ],
        [
            'view' => 'all',
            'edit' => 'owned',
        ],
    ],
    'mergeWhen false' => [
        [
            fn ($mergeWhen) => $mergeWhen(false, [
                'view' => 'all',
                'edit' => 'owned',
            ]),
        ],
        [],
    ],
    'mergeWhen false and have the default value' => [
        [
            fn ($mergeWhen) => $mergeWhen(false, [
                'view' => 'all',
                'edit' => 'owned',
            ], ['delete' => 'none']),
        ],
        ['delete' => 'none'],
    ],
    'merge' => [
        [fn ($merge) => $merge(['view' => 'all', 'delete' => 'none'])],
        ['view' => 'all', 'delete' => 'none'],
    ],
    'unless' => [
        ['is_admin' => fn ($unless) => $unless($isAdmin = false, ['deny' => 'all'])],
        ['is_admin' => ['deny' => 'all']],
    ],
    'mixed raw, when and mergeWhen' => [
        [
            'name'          => 'John Doe',
            'active'        => fn ($when) => $when(true, 'yes', 'no'),
            fn ($mergeWhen) => $mergeWhen(true, [
                'view' => 'all',
                'edit' => 'owned',
            ], [
                'delete' => 'none',
            ]),
            fn ($mergeWhen) => $mergeWhen(false, [], ['isAdmin' => 'no']),
        ],
        [
            'name'    => 'John Doe',
            'active'  => 'yes',
            'view'    => 'all',
            'edit'    => 'owned',
            'isAdmin' => 'no',
        ],
    ],
]);
