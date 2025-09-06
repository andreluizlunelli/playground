<?php

declare(strict_types = 1);

namespace App\Modules\ArrayWrap;

use Closure;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Support\Arr;
use ReflectionFunction;

class ArrayWhen
{
    use ConditionallyLoadsAttributes;

    public static function enableMacro(): void
    {
        Arr::macro('when', app(self::class)->macro());
    }

    public function macro(): callable
    {
        $supportedMethods = [
            'when'        => $this->when(...),
            'merge'       => $this->merge(...),
            'unless'      => $this->unless(...),
            'mergeWhen'   => $this->mergeWhen(...),
            'mergeUnless' => $this->mergeUnless(...),
        ];

        $filter = $this->filter(...);

        $getSupportedMethod = $this->getSupportedMethod(...);
        $isMethodAvailable  = $this->isMethodAvailable(...);

        return function (array $array) use ($getSupportedMethod, $isMethodAvailable, $supportedMethods, $filter) {
            $modified = [];

            foreach ($array as $key => $closure) {
                if ($closure instanceof Closure) {
                    $supportedMethodName = $getSupportedMethod($closure);

                    if (! $isMethodAvailable($supportedMethodName, $supportedMethods)) {
                        throw new \InvalidArgumentException("Closure must have at least one parameter: when, mergeWhen, or mergeUnless. $supportedMethodName called.");
                    }

                    $result = $closure($supportedMethods[$supportedMethodName]);
                } else {
                    $result = $closure;
                }

                $modified[$key] = $result;
            }

            return $filter($modified);
        };
    }

    private function getSupportedMethod(Closure $closure): string
    {
        $parameters = (new ReflectionFunction($closure))->getParameters();

        if (! array_key_exists(0, $parameters)) {
            return '';
        }

        return $parameters[0]->getName();
    }

    private function isMethodAvailable(string $methodName, array $supportedMethods): bool
    {
        $supportedMethodsKeys = array_keys($supportedMethods);

        return $methodName !== '' || in_array($methodName, $supportedMethodsKeys);
    }
}