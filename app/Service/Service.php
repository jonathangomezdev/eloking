<?php

namespace App\Service;

use Illuminate\Http\Request;

abstract class Service
{
    /** @var Request */
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract public function handle($args);

    public static function run(...$args)
    {
        return (new static(request()))->handle(...$args);
    }
}
