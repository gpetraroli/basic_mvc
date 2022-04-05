<?php

class Home extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');

        $this->view('home/index', ['name' => $name]);
    }
}
