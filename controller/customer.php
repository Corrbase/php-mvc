<?php

class customer{
    public $userModel;
    public $postModel;

    public function __construct()
    {
        $this->userModel = model('user');
        $this->postModel = model('post');

        // connect files from model folder\
        // function call - $this->$modelName->functionName()
    }

    public function index(){
        view('index', []);

    }

}
