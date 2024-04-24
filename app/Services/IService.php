<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface IService
{
    public function store(array $data);
    public function getBy(array $criteria);
    public function getOneBy(array $criteria);
}
