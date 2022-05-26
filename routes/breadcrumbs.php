<?php

// Home
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > product
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('home');
    $trail->push("Sản phẩm", route('home'));
});

// Home > category
Breadcrumbs::for('category', function ($trail) {
    $trail->parent('home');
    $trail->push("Danh mục", route('category'));
});

// Home > category > detiail
Breadcrumbs::for('product_detail', function ($trail, $product) {
    $trail->parent('category');
    $trail->push($product->name, route('product_detail', $product->slug));
});

