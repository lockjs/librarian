<?php

namespace Librarian\Resource;

use Exception;

class User
{

    public ?int $id;
    public ?string $email;
    public ?string $created;

    /**
     * The constructor
     */
    public function __construct(array $data)
    {
        $this->validate($data);

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @throws Exception
     */
    private function validate(array &$data)
    {
        $errors = [];

        if (isset($data['email'])) {
            $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Is invalid';
            }
        } else {
            $errors['email'] = 'Is required';
        }

        if ($errors) {
            throw new Exception('', 422);
        }
    }

}