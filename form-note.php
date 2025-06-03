<?php

require __DIR__ . '/config.php';
require __DIR__ . '/src/Repositorys/NoteRepository.php';
require __DIR__ . '/src/Models/Note.php';


$noteRepository = new NoteRepository($pdo);
$note = '';
$id = '';

if(!isset($_GET['id'])){

} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $note = $noteRepository->getNoteById($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Note | Sistema de Notas</title>
    <!--CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/vars-css.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/create-note.css">

    <!--FONTES-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="something">
            <a href="/home.html"><span>&lt;/wolli&gt;</span></a>
        </div>
        <nav class="navigation">
            <a href="/form-note.php"><i class="fa-solid fa-plus"></i></a>
            <a href="/index.html"><i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
    </header>
    <div class="box-conteiner">
        <form action="<?= isset($_GET['id']) ? '/update-note.php?id=' . $note->id : '/create-note.php' ?>" method="post">
            <div class="note-title">
                <label for="title">Title</label>
                <input 
                    class="note-text" 
                    value="<?= $note->title ?? '';?>"
                    type="text" 
                    name="title" 
                    placeholder="Type your note's title..." required>
            </div>
            <div class="note-content">
                <label for="text">Text</label>
                <textarea 
                    maxlength="200" 
                    class="note-text" 
                    name="text" 
                    placeholder="Type your note..." required><?= $note->text ?? '';?></textarea>
            </div>
            <input type="submit" value="Submit" class="button">
        </form>
    </div>
    <footer>
        <p>Created by Wallace Henrique</p>
    </footer>
</body>
</html