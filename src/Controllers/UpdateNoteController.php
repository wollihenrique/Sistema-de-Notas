<?php

namespace App\Controllers;

use App\Repositories\NoteRepository;
use App\Models\Note;

class UpdateNoteController
{
    public function __construct(private NoteRepository $noteRepository){

    }

    public function updateNote(){
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: /?success=0');
            exit();
        }

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

        $note = new Note($id, $title, $text);

        if($this->noteRepository->UpdateNote($note)){
            header('Location: /?success=1');
            exit();
        }
    }

    public function showFilledForm(): void
    {
        $note = '';
        $id = '';

        if(isset($_GET['id'])){
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $note = $this->noteRepository->getNoteById($id);
        } else {
            http_response_code(404);
        }

        require __DIR__ . '/../../public/views/note-form.php';
    }
}