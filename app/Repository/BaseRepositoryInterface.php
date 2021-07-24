<?php


namespace App\Repository;


interface BaseRepositoryInterface
{
    public function all($request);
    public function create(array $properties);
    public function update(array $properties, int $id);
    public function find(int $id);
    public function delete(int $id);
}
