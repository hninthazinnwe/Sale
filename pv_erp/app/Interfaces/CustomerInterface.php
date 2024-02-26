<?php

namespace App\Interfaces;

interface CustomerInterface 
{
    public function index($request);
    public function save($data);
    public function edit($id);

}