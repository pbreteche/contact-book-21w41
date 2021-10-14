<?php

namespace App\Loaders;

use App\Exception\DataNotFoundException;
use App\Model\Contact;

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
        // Activation de la gestion d'erreurs
        // via le mécanisme d'exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function loadAll()
    {
        try {
            $statement = $this->pdo->query('SELECT id, name, email FROM contact');
        } catch (\PDOException $exception) {
            return [
                'status' => 'error',
                'message' => $this->pdo->errorInfo(),
            ];
        }

        return $statement->fetchAll();
    }

    public function loadById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT id, name, email FROM contact WHERE id=:id');
        $statement->bindValue(':id',  $id);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Contact::class);
        $statement->execute();

        if (!$statement) {
            return [
                'status' => 'error',
                'message' => $this->pdo->errorInfo(),
            ];
        }

        if (0 === $statement->rowCount()) {
            throw new DataNotFoundException('Contact non trouvé');
        }

        return $statement->fetch();
    }
}
