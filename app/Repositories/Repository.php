<?php


namespace App\Repositories;


class Repository
{
    protected $user;
    public function __construct()
    {
        $this -> user = auth() -> user();
    }
}
