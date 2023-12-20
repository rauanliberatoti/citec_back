<?php

namespace App\Services\Interface;

interface IService {
    public function handle(mixed ...$data);
}
