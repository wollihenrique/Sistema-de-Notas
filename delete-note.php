<?php

require __DIR__ . '/config.php';
require __DIR__ . '/src/Repositorys/NoteRepository.php';
require __DIR__ . '/src/Models/Note.php';

$noteRepository = new NoteRepository($pdo);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id != null|false){
    $noteRepository->DeleteNote($id);
    header('Location: /home.php?success=1');
    exit;
} else {
    header('Location: /home.php?success=0');
    exit;
}
