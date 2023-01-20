<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Route;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
//https://stackoverflow.com/questions/59149877/visual-studio-code-php-intelephense-keep-showing-not-necessary-error/59266972#59266972
//Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
   
    $trail->push('Dashboard', route('dashboard.index'));
});
//Dashboard > Home
Breadcrumbs::for('dashboard_home', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});
//Dashboard > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('categories', route('categories.index'));
});
//Dashboard > Categories > Add
Breadcrumbs::for('add_category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Add', route('categories.create'));
});
//Dashboard > Categories > Edit
Breadcrumbs::for('edit_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit', route('categories.edit',['category'=>$category]));
});

//Dashboard > Categories > Edit > edit_category_title
Breadcrumbs::for('edit_category_title', function ($trail, $category) {
    $trail->parent('edit_category',$category);
    $trail->push($category->title, route('categories.edit',['category'=>$category]));
});
//Dashboard > Categories > Detail

Breadcrumbs::for('detail_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail', route('categories.show',['category'=>$category]));
});

//Dashboard > Categories > Detail > Detail_category_title
Breadcrumbs::for('detail_category_title', function ($trail, $category) {
    $trail->parent('detail_category',$category);
    $trail->push($category->title, route('categories.show',['category'=>$category]));
});


// TAG

//Dashboard > Tag
Breadcrumbs::for('tags', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('tags.index'));
});


//Dashboard > Tag > Add
Breadcrumbs::for('add_tag', function ($trail) {
    $trail->parent('tags');
    $trail->push('Add', route('tags.create'));
});


//Dashboard > Tag > Edit > edit_tag_title
Breadcrumbs::for('edit_tag', function ($trail, $tag) {
    $trail->parent('tags');
    $trail->push('Edit', route('tags.edit',['tag'=>$tag]));
    $trail->push($tag->title, route('tags.edit',['tag'=>$tag]));

});


//Dashboard > Posts
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('posts.index'));
});

//Dashboard > Posts > Add
Breadcrumbs::for('add_post', function ($trail) {
    $trail->parent('posts');
    $trail->push('Add', route('posts.create'));
});

//Dashboard > Posts > Detail >[title]


Breadcrumbs::for('detail_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Detail', route('posts.show',['post'=>$post]));
    $trail->push($post->title, route('posts.show',['post'=>$post]));

});

//Dashboard > Posts > Edit >[title]

Breadcrumbs::for('edit_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Edit', route('posts.edit',['post'=>$post]));
    $trail->push($post->title, route('posts.edit',['post'=>$post]));

});
// Breadcrumbs::for('detail_post', function ($trail, $post) {
//     $trail->parent('posts');
//     $trail->push('Detail', route('posts.show',['posts'=>$posts]));
//     $trail->push($post->title, route('tags.edit',['tag'=>$tag]));

// });



// Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });