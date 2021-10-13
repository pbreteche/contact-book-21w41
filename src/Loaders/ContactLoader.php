<?php

namespace App\Loaders;

class ContactLoader
{
    private \PDO $pdo;

    public function __construct()
    {
        $config = require __DIR__.'/../../config.php';

        $this->pdo = new \PDO(
            $config['dsn'],
            $config['username'],
            $config['password']
        );
    }

    public function loadAll()
    {
        $statement = $this->pdo->query('SELECT id, name, email FROM contact');

        if (!$statement) {
            return [
                'status' => 'error',
                'message' => $this->pdo->errorInfo(),
            ];
        }

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT id, name, email FROM contact WHERE id=:id');
        $statement->bindValue(':id',  $id);
        $statement->execute();

        if (!$statement) {
            return [
                'status' => 'error',
                'message' => $this->pdo->errorInfo(),
            ];
        }

        if (1 !== $statement->rowCount()) {

        }

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
