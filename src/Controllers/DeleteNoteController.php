<?php

namespace App\Controllers;

use App\Repositories\NoteRepository;

class DeleteNoteController
{
    public function __construct(private NoteRepository $noteRepository){

    }

    public function deleteNote(){
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: /?success=0');
        } else{
            $this->noteRepository->DeleteNote($id);
            header('Location: /?success=1');
            exit;
        }
    }
}