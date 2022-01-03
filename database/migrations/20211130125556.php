<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class V20211130125556 extends AbstractMigration
{
    public function up(): void
    {

        $this->execute("CREATE TABLE IF NOT EXISTS books (
                    id INTEGER PRIMARY KEY,
                    pg_id INTEGER,
                    title TEXT,
                    authors TEXT,
                    categories TEXT,
                    source TEXT)");

        $this->execute("CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY,
                    email TEXT,
                    created DATE default (current_timestamp) not null )");

    }

    public function down(): void
    {
        $this->execute("DROP TABLE IF EXISTS books");
        $this->execute("DROP TABLE IF EXISTS users");
    }
}
