<?php

namespace App;

use DI\Container;
use Slim\Route;
use Slim\Router;

class TwigExtension extends \Twig_Extension
{
	/**
	 * @var Router
	 */
	private $router;
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Router $router, Container $container)
	{
		$this->router = $router;
		$this->container = $container;
	}

	public function getFilters()
	{
		return [
			new \Twig_SimpleFilter('markdown', [$this, 'markdown'], ['is_safe' => ['html']]),
			new \Twig_SimpleFilter('short', [$this, 'short']),
		];
	}

	public function getFunctions()
	{
		return [
			new \Twig_Function('short_str', [$this, 'short_str']),
			new \Twig_Function('getHoursFromDateTime', [$this, 'getHoursFromDateTime']),
			new \Twig_Function('dump', [$this, 'dump']),
			new \Twig_Function('timeago', [$this, 'timeago']),
			new \Twig_Function('ucfirst', [$this, 'ucfirst']),
			new \Twig_Function('timestampToTime', [$this, 'timestampToTime']),
			new \Twig_Function('flash', [$this, 'flash']),
			new \Twig_Function('routeNameFor', [$this, 'routeNameFor']),
			new \Twig_Function('config', [$this, 'config']),
			new \Twig_Function('short', [$this, 'short']),
		];
	}

	public function short_str($string, $long = 20)
	{
		if (strlen($string) > $long) {
			return substr($string, 0, $long) . '...';
		} else {
			return $string;
		}
	}

	public function ucfirst($string)
	{
		return ucfirst($string);
	}


	public function markdown($value)
	{
		$Parsedown = new \Parsedown();

		return $Parsedown->text($value);
	}

	public function short($string, $max = 20)
	{
		return substr($string, 0, $max);
	}

	public function getHoursFromDateTime($date)
	{
		$dt = \DateTime::createFromFormat("Y-m-d H:i:s", $date);
		$hours = $dt->format('H:i');

		return $hours;
	}

	public function timeago($date)
	{
		$timeAgo = new \Westsworld\TimeAgo(NULL, 'fr');

		return ucfirst(
			$timeAgo->inWords(
				$date
			)
		);
	}

	public function timestampToTime($date)
	{
		return date('Y-m-d H:i:s', $date);
	}

	public function dump($value)
	{
		di($value);
	}

	public function routeNameFor($url, $names)
	{
		$i = 0;
		while ($i < count($names)) {
			$route = $this->router->getNamedRoute($names[$i]);
			$pattern = $route->getPattern();
			if ($pattern == $url OR $pattern) {
				return true;
			}
			$i++;
		}
	}

	public function config($key) {
		return $this->container->get($key);
	}

}