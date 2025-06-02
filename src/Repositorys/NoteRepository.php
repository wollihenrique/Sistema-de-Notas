<?php

class NoteRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createNote(Note $note): ?Note
    {
        $query = "INSERT INTO notas (title, text) VALUES (?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $note->title);
        $statement->bindValue(2, $note->text);
        $success = $statement->execute();

        if($success){
            $id = $this->pdo->lastInsertId();
            return new Note($id, $note->title, $note->text);
        }

        return null;
    }

    public function getAllNotes(): ?array
    {
        $query = "SELECT * FROM notas";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute();
        $allNotes = [];

        if($success){
            $allNotes = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->hydrateNotes($allNotes);
        } else {
            return null;
        }
    }

    public function getNoteById(int $id): Note
    {
        $query = "SELECT * FROM notas WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $id);
        $statement->execute();
        $pdoNote = $statement->fetch(PDO::FETCH_ASSOC);
        $note = new Note($pdoNote['id'], $pdoNote['title'], $pdoNote['text']);

        return $note;
    }

    public function hydrateNotes(array $allNotes): array
    {
        $hydratedList = array_map(function($note){
            $Hydratednote = new Note($note['id'], $note['title'], $note['text']);
            return $Hydratednote;
        }, $allNotes);

        return $hydratedList;
    }
}