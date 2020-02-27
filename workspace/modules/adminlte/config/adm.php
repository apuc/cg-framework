<?php

return [
    'adminlte-module' => 'success',
    'leftMenu' => [
        [
            'title' => 'Пользователи',
            'url' => '#',
            'icon' => '<i class="nav-icon fas fa-copy"></i>',
            'sub' => [
                [
                    'title' => 'Добавить',
                    'url' => 'url/add'
                ],
                [
                    'title' => 'Список',
                    'url' => 'url/list'
                ],
            ]
        ],
        [
            'title' => 'Страница',
            'url' => 'page',
            'icon' => '<i class="nav-icon fas fa-copy"></i>',
        ],
    ]
];