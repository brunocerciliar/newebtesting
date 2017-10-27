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

    public function invoke($book = "")
    {
        // var_dump($book);
        if ($book == "")
        {
            $myName = "bruno";
            $books = $this->model->getBookList();
            return $this->view('book.list', compact('books', 'myName'));
        }
        else
        {
            $book = $this->model->getBook($book);
            return $this->view('book.view', compact('book'));
        }
    }
}
