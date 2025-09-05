<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public function render(): View|Closure|string
    {
        $user = auth()->user();

        $routes = Arr::when([
            'index' => route('home'),
            'horizon' => fn ($when) => $when($user->email === 'dev@role.com', route('horizon.index')),
            fn ($mergeWhen) => $mergeWhen($user->isAdmin(), [
                'orders' => route('orders'),
                'payments' => route('payments'),
            ]),
        ]);

        return view('components.navigation', [
            'routes' => $routes,
        ]);
    }
}
