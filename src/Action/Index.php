<?php

namespace Librarian\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Index
{
    public function __construct()
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $response->getBody()->write(file_get_contents(__DIR__ . '/../../web/templates/index.html'));

        return $response;
    }

}