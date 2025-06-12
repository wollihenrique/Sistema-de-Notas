<?php

use App\Controllers\HomeController;
use App\Controllers\NewNoteController;
use App\Controllers\UpdateNoteController;
use App\Controllers\DeleteNoteController;

return [
    '/' => [
        'GET' => [
            'controller' => HomeController::class,
            'method' => 'showHomePage'
        ],
        'POST' => [
            'controller' => HomeController::class,
            'method' => 'showHomePage'
        ]
    ],

    '/form-note' => [
        'GET' => [
            'controller' => NewNoteController::class,
            'method' => 'showForm'
        ],
        'POST' => [
            'controller' => NewNoteController::class,
            'method' => 'createNote'
        ]
    ],

    '/update-note' => [
        'GET' => [
            'controller' => UpdateNoteController::class,
            'method' => 'showFilledForm'
        ],
        'POST' => [
            'controller' => UpdateNoteController::class,
            'method' => 'updateNote'
        ]
    ],

    '/delete-note' => [
        'GET' => [
            'controller' => DeleteNoteController::class,
            'method' => 'deleteNote'
        ],
        'POST' => [
            'controller' => DeleteNoteController::class,
            'method' => 'deleteNote'
        ]
    ]
];