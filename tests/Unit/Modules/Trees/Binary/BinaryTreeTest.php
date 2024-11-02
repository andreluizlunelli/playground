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
    $tree->add(20);
    $tree->add(18);
    $tree->add(19);

    expect($tree->root->right->value)->toBe(6);
    expect($tree->root->right->right->value)->toBe(7);
    expect($tree->root->right->right->right->value)->toBe(8);
    expect($tree->root->right->right->right->right->value)->toBe(9);
    expect($tree->root->right->right->right->right->right->value)->toBe(20);

    expect($tree->root->right->right->right->right->right->left->value)->toBe(18);
    expect($tree->root->right->right->right->right->right->left->right->value)->toBe(19);

    expect($tree->root->left->value)->toBe(4);
    expect($tree->root->left->left->value)->toBe(3);
    expect($tree->root->left->left->left->value)->toBe(2);

    //              5
    //          4       6
    //      3               7
    //  2                       8
    //                              9
    //                                  20
    //                              18
    //                                  19
});

it('should in order traversal', function () {
    $tree = new Tree(new Node(5));

    array_map(fn(int $number) => $tree->add($number), [4, 6, 3, 7, 8, 9, 2, 20, 18, 19]);

    expect($tree->inOrderTraversal())->toBe([2, 3, 4, 5, 6, 7, 8, 9, 18, 19, 20]);
});


