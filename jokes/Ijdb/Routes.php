<?php
namespace Ijdb;

class Routes implements \CSY2028\Routes {
	public function getRoutes() {
		require '../database.php';

		$categoriesTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');
		$authorsTable = new \CSY2028\DatabaseTable($pdo, 'author', 'id');
		$jokesTable = new \CSY2028\DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [$authorsTable, $categoriesTable]);

		$jokeController = new \Ijdb\Controllers\Joke($jokesTable, $categoriesTable);
		$categoryController = new \Ijdb\Controllers\Category($categoriesTable);
		$authorController = new \Ijdb\Controllers\Author($authorsTable);
		
		$routes = [
			'' => [
				'GET' => [
					'controller' => $jokeController,
					'function' => 'home'
				]
			],
			'joke/list' => [
				'GET' => [
					'controller' => $jokeController,
					'function' => 'list'
				]
			],
			'joke/edit' => [
				'GET' => [
					'controller' => $jokeController,
					'function' => 'editForm'
				],	
				'POST' => [
					'controller' => $jokeController,
					'function' => 'editSubmit'
				],
				'login' => true
			],
			'joke/delete' => [
				'POST' => [
					'controller' => $jokeController,
					'function' => 'delete'
				],
				'login' => true
			],
			'category/list' => [
				'GET' => [
					'controller' => $categoryController,
					'function' => 'list'
				]
			],
			'category/edit' => [
				'GET' => [
					'controller' => $categoryController,
					'function' => 'editForm'
				],	
				'POST' => [
					'controller' => $categoryController,
					'function' => 'editSubmit'
				],
				'login' => true
			],
			'category/delete' => [
				'POST' => [
					'controller' => $categoryController,
					'function' => 'delete'
				],
				'login' => true
			],
			'author/register' =>[
				'GET' => [
					'controller' => $authorController,
					'function' => 'registerForm'
				],
				'POST' => [
					'controller' => $authorController,
					'function' => 'registerSubmit'
				]
			],
			'author/login' => [
				'GET' => [
					'controller' => $authorController,
					'function' => 'loginForm'
				],
				'POST' => [
					'controller' => $authorController,
					'function' => 'loginSubmit'
				]
			],
			'author/logout' => [
				'GET' => [
					'controller' => $authorController,
					'function' => 'logout'
				],
				'login' => true
			]
		];

		return $routes;
	}

	public function checkLogin(){
		//session_start(); This line has already been used on index.php for layout, remove comment tag otherwise.
		if (!isset($_SESSION['loggedin'])){
			header('location: /joke/list');
		}
	}
}