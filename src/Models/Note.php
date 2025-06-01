<?php

class Note
{
    public readonly ?int $id;
    public  readonly string $title;
    public readonly string $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }
}