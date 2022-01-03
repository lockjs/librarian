<?php

namespace Librarian\Repository;

use Exception;
use Librarian\Resource\User;
use PDO;

class UserStore
{

    private $connection;

    /**
     * The constructor
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Save the provided User object in the database
     *
     * If the User doesn't currently exist in the data store, a new entry will be created and the object will be
     * updated as appropriate.
     *
     * @param User $user
     */
    public function save(User $user): void
    {
        // Create a new user if user.id isn't set
        if (!isset($user->id)) {
            $this->create($user);
        }
    }

    /**
     * Populate a user object with data from the datastore
     *
     * @param User $user
     */
    private function hydrate(User $user): void
    {
        $sql = "SELECT * FROM users
                WHERE users.id = :id;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $user->id);
        $stmt->execute();

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        foreach ($user_data as $key => $value) {
            if (property_exists($user, $key)) {
                $user->{$key} = $value;
            }
        }

    }

    /**
     * Create a new User object in the database
     *
     * @param User $user
     * @throws Exception
     */
    private function create(User $user): void
    {
        $sql = "INSERT INTO users (email) 
                VALUES (:email);";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam('email', $user->email);

        if ($stmt->execute()) {
            $user->id = (int)$this->connection->lastInsertId();
            $this->hydrate($user);
        } else {
            throw new Exception("Unable to create new user");
        }
    }

    /**
     * Delete the provided User object from the datastore
     *
     * @param User $user
     */
    public function delete(User $user): void
    {
    }

    /**
     * Update an existing User object
     *
     * @param User $user
     */
    private function update(User $user): void
    {
    }


}