<?php
/*
|--------------------------------------------------------------------------
| Web routing
|--------------------------------------------------------------------------
|
| Register it all your normal routes
|
*/

$app->get('/', [\App\Controllers\HomeController::class, 'getHome'])->setName('home');
$app->get('/a-propos', [\App\Controllers\PageController::class, 'getAbout'])->setName('about');
$app->get('/cabaret', [\App\Controllers\PageController::class, 'getCabaret'])->setName('cabaret');
$app->get('/tour', [\App\Controllers\PageController::class, 'getTour'])->setName('tour');
$app->get('/actualites', [\App\Controllers\BlogController::class, 'getPosts'])->setName('blog.posts');
$app->get('/actualites/{slug}/{id}', [\App\Controllers\BlogController::class, 'getPost'])->setName('blog.post');
$app->get('/mentions-legales', [\App\Controllers\PageController::class, 'getLegals'])->setName('legals');
$app->get('/nous-contacter', [\App\Controllers\PageController::class, 'getContact'])->setName('contact');

$app->get('/instagram/login', [App\Controllers\InstagramController::class, 'getUrl'])->setName('instagram.login');
$app->get('/instagram/authorize', [App\Controllers\InstagramController::class, 'getAuthorize'])->setName('instagram.authorize');