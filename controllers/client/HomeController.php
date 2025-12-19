<?php

class HomeController
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function index() 
    {
        $view = 'home';
        $header = 'header';
        $top4Lasted = $this->productModel->top4Lasted();
        $top4View = $this->productModel->top4View();
        require_once PATH_VIEW_CLIENT_MAIN;
    }
     
}