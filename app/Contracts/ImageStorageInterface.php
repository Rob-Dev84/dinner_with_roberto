<?php

//TODO implemet a abstract

namespace App\Contracts;

interface ImageStorageInterface
{
    public function store(string $filePath, string $fileName, string $destinationPath): string;

    public function delete(string $filePath): bool;
}




