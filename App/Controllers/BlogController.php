<?php
/**
 * Developed by: mbess
 * Date: 26/02/2018
 * Time: 16:08
 */

namespace App\Controllers;


use App\Post;
use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\NotFoundException;

class BlogController extends Controller
{
	public function getPosts(ServerRequestInterface $request, ResponseInterface $response, Manager $manager)
	{
		$posts = Post::with('user')->get();
		return $this->render($response, 'blog.posts', [
			'posts' => $posts->toArray()
		]);
	}

	public function getPost($id, ServerRequestInterface $request, ResponseInterface $response, Manager $manager)
	{
		$post = Post::with('user')->find($id);

		if ($post) {
			return $this->render($response, 'blog.post', [
				'post' => $post->toArray()
			]);
		} else {
			throw new NotFoundException($request, $response);
		}
	}
}