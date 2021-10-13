<?php
namespace Ijdb\Entity;
class Joke {
    public $authorsTable;
    public $categoriesTable;

    public $id;
    public $joketext;
    public $jokedate;
    public $authorID;
    public $categoryID;

    public function __construct(\CSY2028\DatabaseTable $authorsTable, $categoriesTable) {
        $this->authorsTable = $authorsTable;
        $this->categoriesTable = $categoriesTable;
    }

    public function getAuthor() {
        return $this->authorsTable->find('id', $this->authorID)[0];
    }

    public function getCategory() {
        return $this->categoriesTable->findAll();
    }
}