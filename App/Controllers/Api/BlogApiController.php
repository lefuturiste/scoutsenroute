<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Post;
use App\User;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use STAILEUAccounts\STAILEUAccounts;
use Validator\Validator;

class BlogApiController extends Controller
{

	public function all(ServerRequestInterface $request, ResponseInterface $response, Manager $manager)
	{
		return $response->withJson([
			'success' => true,
			'data' => Post::with('user')->get()->toArray()
		]);
	}

	public function view($id, ServerRequestInterface $request, ResponseInterface $response, Manager $manager)
	{
		$post = Post::with('user')->find($id);
		if ($post) {
			return $response->withJson([
				'success' => true,
				'data' => $post
			]);
		} else {
			return $response->withJson([
				'success' => false,
			])->withStatus(404);
		}
	}

	public function store(ServerRequestInterface $request, ResponseInterface $response, STAILEUAccounts $STAILEUAccounts, Manager $manager, Slugify $slugify)
	{
		$validator = new Validator($request->getParsedBody());
		$validator->required('title', 'content', 'user_id');
		$validator->notEmpty('title', 'content', 'user_id');
		$validator->length('content', '42');
		if ($validator->isValid()) {
			$post = new Post();
			$post->id = uniqid();
			$post->title = $validator->getValue('title');
			$post->slug = $slugify->slugify($validator->getValue('title'));
			$post->summary = $validator->getValue('summary');
			$post->thumb_url = $validator->getValue('thumb_url');
			$post->content = $validator->getValue('content');
			if (User::find($validator->getValue('user_id')) == NULL){
				$user = [
					'id' => $validator->getValue('user_id'),
					'username' => $STAILEUAccounts->getUsername($validator->getValue('user_id')),
					'avatar_url' => $STAILEUAccounts->getAvatar($validator->getValue('user_id'))->getUrl()
				];
				$post->user()->create($user);
			}else{
				$post->user()->associate($validator->getValue('user_id'));
			}
			$post->save();

			return $response->withJson([
				'success' => true,
				'data' => $post->toArray()
			]);
		} else {
			return $response->withJson([
				'success' => false,
				'data' => $validator->getErrors()
			])->withStatus(400);
		}
	}

	public function update($id, ServerRequestInterface $request, ResponseInterface $response, STAILEUAccounts $STAILEUAccounts, Manager $manager, Slugify $slugify)
	{
		$post = Post::find($id);
		if ($post) {
			$validator = new Validator($request->getParsedBody());
			$validator->required('title', 'content', 'user_id');
			$validator->notEmpty('title', 'content', 'user_id');
			$validator->length('content', '42');
			if ($validator->isValid()) {
				$post->title = $validator->getValue('title');
				$post->slug = $slugify->slugify($validator->getValue('title'));
				$post->thumb_url = $validator->getValue('thumb_url');
				$post->cover_url = $validator->getValue('cover_url');
				$post->summary = $validator->getValue('summary');
				$post->content = $validator->getValue('content');
				if (User::find($validator->getValue('user_id')) == NULL){
					$user = [
						'id' => $validator->getValue('user_id'),
						'username' => $STAILEUAccounts->getUsername($validator->getValue('user_id')),
						'avatar_url' => $STAILEUAccounts->getAvatar($validator->getValue('user_id'))->getUrl()
					];
					$post->user()->create($user);
				}else{
					$post->user()->associate($validator->getValue('user_id'));
				}
				$post->save();

				return $response->withJson([
					'success' => true,
					'data' => $post->toArray()
				]);
			} else {
				return $response->withJson([
					'success' => false,
					'data' => $validator->getErrors()
				])->withStatus(400);
			}
		} else {
			return $response->withJson([
				'success' => false,
			])->withStatus(404);
		}
	}

	public function destroy($id, ServerRequestInterface $request, ResponseInterface $response, Manager $manager)
	{
		$post = Post::find($id);
		if ($post) {
			Post::destroy($id);
			return $response->withJson([
				'success' => true
			]);
		} else {
			return $response->withJson([
				'success' => false,
			])->withStatus(404);
		}
	}
}