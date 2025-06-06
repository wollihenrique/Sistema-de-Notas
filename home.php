<?php
    require __DIR__ . '/config.php';
    require __DIR__ . '/src/Models/Note.php';
    require __DIR__ . '/src/Repositorys/NoteRepository.php';

    $noteRepository = new NoteRepository($pdo);

    $allNotes = $noteRepository->getAllNotes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Sistema de Notas</title>
    <!--CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/vars-css.css">
    <link rel="stylesheet" href="/css/home.css">

    <!--FONTES-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="something">
            <span>&lt;/wolli&gt;</span>
        </div>
        <nav class="navigation">
            <a href="/form-note.php"><i class="fa-solid fa-plus"></i></a>
            <a href="/index.html"><i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
    </header>
    <div class="notes-conteiner">
        <?php foreach($allNotes as $note): ?>
        <div class="note">

            <p>Uploaded by:</p>
            
            <a href="/form-note.php?id=<?= $note->id?>">
                <div class="note-text">
                    <h2><?= $note->text ?></h2>
                </div>
            </a>

            <div class="title">
                <h2><?= $note->title ?></h2>
            </div>

            <div class="options">
                <a href="/form-note.php?id=<?= $note->id?>">Editar</a>
                <a href="/delete-note.php?id=<?= $note->id?>">Excluir</a>
            </div>
        </div>    
        <?php endforeach; ?>

    </div>
    <footer>
        <p>Created by Wallace Henrique</p>
    </footer>
</body>
</html>