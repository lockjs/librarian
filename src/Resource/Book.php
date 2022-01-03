<?php

namespace Librarian\Resource;

class Book
{

    private $datastore;

    public function __construct( $datastore ) {
        $this->datastore = $datastore;
    }

    public static function load( $id , $datastore ) {

        if (is_null($id)) {
            // fetch random
        }

        // fetch by id
    }

    public function save() {

    }



}