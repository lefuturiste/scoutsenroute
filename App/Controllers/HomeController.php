<?php

namespace App\Controllers;

use App\Post;
use DI\Container;
use Illuminate\Database\Capsule\Manager;
use MetzWeb\Instagram\Instagram;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class HomeController extends Controller
{
	public function getHome(ServerRequestInterface $request, ResponseInterface $response, Manager $manager, Instagram $instagram, Container $container)
	{
		$lastInstagramPosts = $instagram->getUserMedia('self', 4)->data;
		$posts = Post::with('user')->get();
		return $this->render($response, 'pages.home', [
			'posts' => $posts->toArray(),
			'lastInstagramPosts' => $lastInstagramPosts
		]);
	}
}