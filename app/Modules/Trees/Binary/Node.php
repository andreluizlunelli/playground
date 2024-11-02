<?php

namespace App\Modules\Trees\Binary;

class Node
{
    public function __construct(
        public ?int $value,
        public ?self $left = null,
        public ?self $right = null,
    ) {}
}
