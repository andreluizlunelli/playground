<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegularNavigation extends Component
{
    public function render(): View|Closure|string
    {
        $user = auth()->user();

        $routes = [
            'index' => route('home'),
        ];

        if ($user->isAdmin()) {
            $routes['orders'] = route('orders');
            $routes['payments'] = route('payments');
        }

        if ($user->email === 'dev@role.com') {
            $routes['horizon'] = route('horizon.index');
        }

        return view('components.regular-navigation', [
            'routes' => $routes,
        ]);
    }
}
