<?php

namespace App\Modules\Trees\Binary;

class Tree
{
    public function __construct(public Node $root) {}

    public function add(int $value): void
    {
        $nodeToAdd = new Node($value);

        $parentNode = $this->findParentNode($nodeToAdd);

        if ($parentNode === null) {
            return;
        }

        match ($parentNode->value <=> $nodeToAdd->value) {
            -1 => $parentNode->right = $nodeToAdd,
            1  => $parentNode->left = $nodeToAdd,
        };
    }

    private function findParentNode(Node $nodeToAdd): Node
    {
        $currentNode = $this->root;
        $parentNode = null;

        while ($currentNode !== null) {
            $parentNode = $currentNode;

            $compare = $currentNode->value <=> $nodeToAdd->value;

            $currentNode = match ($compare) {
                1 => $currentNode->left,
                -1 => $currentNode->right,
            };
        }

        return $parentNode;
    }
}
