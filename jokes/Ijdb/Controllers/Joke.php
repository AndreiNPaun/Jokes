<?php
namespace Ijdb\Controllers;
class Joke {
	private $jokesTable;
	private $categoriesTable;

	public function __construct($jokesTable, $categoriesTable) {
		$this->jokesTable = $jokesTable;
		$this->categoriesTable = $categoriesTable;
	}

	public function list() {

		$jokes = $this->jokesTable->findAll();

		return ['template' => 'list.html.php',
				'title' => 'Joke List',
				'variables' => [
						'jokes' => $jokes
					]
				];
	}

	public function delete() {
		$this->jokesTable->delete($_POST['id']);

		header('location: /joke/list');
	}

	public function home() {
		$joke = $this->jokesTable->find('id', 1);

		return [
			'template' => 'home.html.php',
			'variables' => ['joke' => $joke[0]],
			'title' => 'Internet Joke Database'
		];

	}

	public function editSubmit() {

		$date = new \DateTime();

		$joke = $_POST['joke'];
		$joke['jokedate'] = $date->format('Y-m-d H:i:s');

		$this->jokesTable->save($joke);

		header('location: /joke/list');
	}

	public function editForm(){
		if  (isset($_GET['id'])) {
			$result = $this->jokesTable->find('id', $_GET['id']);
			$joke = $result[0];
			$category = $this->categoriesTable->findAll();
		}
		else  {
			$joke = false;
		}

		return [
			'template' => 'editjoke.html.php',
			'variables' => [
				'joke' => $joke,
				'category' => $category
			],
			'title' => 'Edit Joke'
		];
	}
}