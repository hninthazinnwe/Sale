<?php

namespace App\Interfaces;

interface UomInterface {

    public function index($request);
    public function save($data);
    public function edit($id);
}