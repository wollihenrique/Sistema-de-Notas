<?php

require __DIR__ . '/config.php';
require __DIR__ . '/src/Repositorys/NoteRepository.php';
require __DIR__ . '/src/Models/Note.php';


$noteRepository = new NoteRepository($pdo);

$title = filter_input(INPUT_POST, 'title');
$text = filter_input(INPUT_POST, 'text');

if($title === false || null){
    header('Location: /home.php');
    exit();
}

if($text === false || null){
    header('Location: /home.php');
    exit();
}

$note = new Note(null, $title, $text);
$success = $noteRepository->createNote($note);

if($success === false){
    header('Location: /home.php?success=0');
    exit;
}  else {
    header('Location: /home.php');
}

