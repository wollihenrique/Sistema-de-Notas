<?php

require __DIR__ . '/config.php';
require __DIR__ . '/src/Repositorys/NoteRepository.php';
require __DIR__ . '/src/Models/Note.php';

$noteRepository = new NoteRepository($pdo);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if($id == null || false){
    header('Location: /home.php?success=0');
    exit();
}

$title = filter_input(INPUT_POST, 'title');
if($title === false || null){
    header('Location: /home.php?success=0');
    exit();
}

$text = filter_input(INPUT_POST, 'text');
if($text === false || null){
    header('Location: /home.php?success=0');
    exit();
}

$note = new Note($id, $title, $text);

if($noteRepository->UpdateNote($note)){
    header('Location: /home.php?success=1');
    exit();
}


