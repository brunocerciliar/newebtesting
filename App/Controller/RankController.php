<?php
namespace App\Controller;

use \App\Model\Role;

class RankController extends Controller
{ 

    public function index()
    {
        return $this->view('rank.index');
    }

}
