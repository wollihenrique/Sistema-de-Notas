<?php

namespace App\Controllers;

use App\Repositories\NoteRepository;

class HomeController
{

    public function __construct(private NoteRepository $noteRepository)
    {

    }
    
    public function showHomePage()
    {
        $allNotes = $this->noteRepository->getAllNotes();
        require __DIR__ . '/../../public/views/home.php';
    }
}