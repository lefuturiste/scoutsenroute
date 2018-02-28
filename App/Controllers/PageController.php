<?php
/**
 * Developed by: mbess
 * Date: 26/02/2018
 * Time: 15:43
 */

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PageController extends Controller
{
	public function getAbout(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'pages.about');
	}

	public function getContact(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'pages.contact');
	}

	public function getLegals(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'pages.legals');
	}

	public function getCabaret(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'pages.carabet');
	}

	public function getTour(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'pages.tour');
	}
}