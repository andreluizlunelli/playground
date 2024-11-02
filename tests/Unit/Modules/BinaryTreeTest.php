<?php

use App\Modules\Trees\Binary\Node;
use App\Modules\Trees\Binary\Tree;

it('shold add node to the correct side', function () {
    $tree = new Tree(new Node(5));
    $tree->add(4);
    $tree->add(6);
    $tree->add(3);
    $tree->add(7);
    $tree->add(8);
    $tree->add(9);
    $tree->add(2);


    expect($tree->root->right->value)->toBe(6);
    expect($tree->root->right->right->value)->toBe(7);
    expect($tree->root->right->right->right->value)->toBe(8);
    expect($tree->root->right->right->right->right->value)->toBe(9);

    expect($tree->root->left->value)->toBe(4);
    expect($tree->root->left->left->value)->toBe(3);
    expect($tree->root->left->left->left->value)->toBe(2);
});
