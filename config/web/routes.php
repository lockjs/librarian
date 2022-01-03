<?php

use Slim\App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

return function (App $app) {
    $app->get('/', \Librarian\Action\Index::class);

    $app->post('/register', \Librarian\Action\Register::class);
    $app->get('/registered', [\Librarian\Action\Register::class, 'registered']);
};
