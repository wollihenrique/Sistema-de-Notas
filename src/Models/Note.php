<?php

namespace App\Models;

class Note
{
    public readonly ?int $id;
    public  readonly string $title;
    public readonly string $text;

    public function __construct(?int $id, string $title, string $text)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
    }
}