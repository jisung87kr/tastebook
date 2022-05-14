<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Database\Eloquent\Model;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('홈', route('posts.index'));
});

// dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('대시보드', route('dashboard'));
});

Breadcrumbs::macro('resource', function (string $name, string $title, string $modelTitle='title', string $parent='home') {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title, $parent) {
        $trail->parent($parent);
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('등록', route("{$name}.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("{$name}.show", function (BreadcrumbTrail $trail, Model $model) use ($name, $modelTitle) {
        $trail->parent("{$name}.index");
        $trail->push($model->$modelTitle, route("{$name}.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail, Model $model) use ($name) {
        $trail->parent("{$name}.show", $model);
        $trail->push('수정', route("{$name}.edit", $model));
    });
});

Breadcrumbs::resource('posts', '포스트', 'subject');
Breadcrumbs::resource('admin.posts', '포스트', 'subject');