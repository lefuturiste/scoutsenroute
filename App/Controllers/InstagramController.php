<?php

namespace App\Controllers;

use MetzWeb\Instagram\Instagram;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class InstagramController extends Controller
{
	public function getUrl(ServerRequestInterface $request, ResponseInterface $response, Instagram $instagram)
	{
		return $this->redirect($response, $instagram->getLoginUrl());
	}

	public function getAuthorize(ServerRequestInterface $request, ResponseInterface $response, Instagram $instagram)
	{
		$result = (array)$instagram->getOAuthToken($request->getQueryParams()['code']);
		if (isset($result['access_token'])) {

			return $response->write('The access token is : ' . $result['access_token']);
		} else {

			return $response->write('error with instagram api');
		}
	}
}