<?php

namespace App\Controllers;

use App\Repositories\NoteRepository;
use App\Models\Note;

class NewNoteController
{
    public function __construct(private NoteRepository $noteRepository){

    }

    public function createNote(): bool
    {
        $title = filter_input(INPUT_POST, 'title');
        if(!$title){
            header('Location: /?success=0');
            exit();
        }

        $text = filter_input(INPUT_POST, 'text');
        if(!$text){
            header('Location: /?success=0');
            exit();
        }

        $note = new Note(null, $title, $text);
        $success = $this->noteRepository->createNote($note);

        if($success){
            header('Location: /?success=1');
            exit();
        } else {
            header('Location: /?success=0');
            exit();
        }
    }

    public function showForm(){
        require __DIR__ . '/../../public/views/note-form.php';
    }
}