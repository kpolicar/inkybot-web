<?php namespace App;


use Illuminate\Support\Collection;

/**
 * @mixin Collection
 */
class ClientVersion
{
    public $versions;

    public function __construct()
    {
        $this->versions = new Collection([
            1 => [
                'number' => 1,
                'code' => 'v0.1beta',
                'name' => 'v0.1 Beta',
            ],
            2 => [
                'number' => 2,
                'code' => 'v0.2beta',
                'name' => 'v0.2 Beta',
            ],
            3 => [
                'number' => 3,
                'code' => 'v0.3beta',
                'name' => 'v0.3 Beta',
            ],
            4 => [
                'number' => 4,
                'code' => 'v0.4beta',
                'name' => 'v0.4 Beta',
            ],
            5 => [
                'number' => 5,
                'code' => 'v0.5beta',
                'name' => 'v0.5 Beta',
            ],
            6 => [
                'number' => 6,
                'code' => 'v0.6beta',
                'name' => 'v0.6 Beta',
            ],
            7 => [
                'number' => 7,
                'code' => 'v0.7beta',
                'name' => 'v0.7 Beta',
            ],
            8 => [
                'number' => 8,
                'code' => 'v0.8beta',
                'name' => 'v0.8 Beta',
            ],
            9 => [
                'number' => 9,
                'code' => 'v0.9beta',
                'name' => 'v0.9 Beta',
            ],
            10 => [
                'number' => 10,
                'code' => 'v0.10beta',
                'name' => 'v0.10 Beta',
            ],
            11 => [
                'number' => 11,
                'code' => 'v0.11beta',
                'name' => 'v0.11 Beta',
            ],
            12 => [
                'number' => 12,
                'code' => 'v0.12beta',
                'name' => 'v0.12 Beta',
            ],
            13 => [
                'number' => 13,
                'code' => 'v1',
                'name' => 'v1.0',
            ],
            14 => [
                'number' => 14,
                'code' => 'v1.1',
                'name' => 'v1.1',
            ],
        ]);
    }

    public function latest()
    {
        return $this->last();
    }

    public function __call($name, $arguments)
    {
        return $this->versions->$name(...$arguments);
    }
}
