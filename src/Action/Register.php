<?php

namespace Librarian\Action;

use Librarian\Repository\UserStore;
use Librarian\Resource\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Register
{
    private UserStore $userStore;

    public function __construct(UserStore $repository) {
        $this->userStore = $repository;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        $user = new User($data);
        $this->userStore->save($user);

        return $response->withHeader('Location', '/registered')->withStatus(302);
    }

    public function registered(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $response->getBody()->write("Registration complete");
        return $response;
    }

}