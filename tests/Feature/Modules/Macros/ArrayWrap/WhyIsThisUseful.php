<?php

use App\Models\User;
use App\Modules\Macros\ArrayWrap\ArrayWhen;
use Illuminate\Foundation\Testing\RefreshDatabase as RefreshDatabaseAlias;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

beforeEach(fn () => ArrayWhen::enableMacro());

uses(RefreshDatabaseAlias::class);

test('you can use it for manage a navigation menu links', function () {
    $guest = User::factory()->create(['email' => 'guest@gmail.com']);

    actingAs($guest);

    $routes = Arr::when([
        'index' => 'home',
        'payments' => fn ($when) => $when(auth()->user()->isAdmin(), '/payments/index')
    ]);

    assertSame(['index' => 'home'], $routes);
});

test('you can use it for adding many links at once', function () {
    $admin = User::factory()->create(['email' => 'admin@gmail.com']);

    actingAs($admin);

    $routes = Arr::when([
        'index' => 'home',
        fn ($mergeWhen) => $mergeWhen(auth()->user()->isAdmin(), [
            'orders' => '/orders',
            'payments' => '/payments/history',
        ])
    ]);

    assertSame([
        'index' => 'home',
        'orders' => '/orders',
        'payments' => '/payments/history',
    ], $routes);
});