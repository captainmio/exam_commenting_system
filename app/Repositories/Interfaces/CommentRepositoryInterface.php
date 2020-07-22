<?php
namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function store(string $name, int $parent_id, $body): int;

    public function findByParentId(int $parent_id): collection;
}