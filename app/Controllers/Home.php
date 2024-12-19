<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {   
        $data['pageName'] = 'home_page';
        $data['pageData'] = [];
        return view('template',$data);
    }
}
