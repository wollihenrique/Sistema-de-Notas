<?php

namespace App\Repositories;

use App\Models\Note;
use PDO;

class NoteRepository
{
    private PDO $pdo;
    public Note $note;

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
        $success = $statement->execute();

        if($success){
            $id = $this->pdo->lastInsertId();
            $this->note = new Note($id, $note->title, $note->text);
            return true;
        } else {
            return false;
        }
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

    public function DeleteNote(int $id): bool {
        $query = "DELETE FROM notas WHERE id = ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $id);

        if($statement->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function UpdateNote(Note $note){
        $query = "UPDATE notas SET title = :title, text = :text WHERE id = :id;";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $note->title);
        $statement->bindValue(':text', $note->text);
        $statement->bindValue(':id', $note->id);

        if($statement->execute()){
            return true;
        } else {
            return false;
        }
    }
}