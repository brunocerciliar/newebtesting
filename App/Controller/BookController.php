<?php
namespace App\Controller;

use \App\Model\Model;

class BookController extends Controller
{ 
    public $model;

    public function __construct()
    {
        $this->model = new Model;
    }

    public function invoke($id)
    {
        echo "Eu sou o ID" . $id;
        if (!isset($_GET['book']))
        {
            $myName = "bruno";
            $books = $this->model->getBookList();
            return $this->view('book.list', compact('books', 'myName'));
        }
        else
        {
            $book = $this->model->getBook($_GET['book']);
            return $this->view('book.view', compact('book'));
        }
    }
}

?>