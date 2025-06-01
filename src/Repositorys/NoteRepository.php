<?php

class NoteRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createNote(Note $note): bool
    {
        $query = "INSERT INTO notas (title, text) VALUES (?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $note->title);
        $statement->bindValue(2, $note->text);
        return $statement->execute();
    }
}