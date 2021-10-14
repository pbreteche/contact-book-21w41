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

        /* Parcours des résultats avec une boucle
        $result = [];
        foreach ($statement as $row) {
            $result[] = $row;
        }

        while($row = $statement->fetch()) {

        }*/

        return $statement->fetchAll();
    }

    public function loadById(int $id)
    {
        $statement = $this->pdo->prepare(
            'SELECT id, name, email FROM contact WHERE id=:id'
        );
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

    public function save(Contact $contact)
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO contact (name, email) VALUES (:name, :email)'
        );
        $statement->bindValue(':name',  $contact->getName());
        $statement->bindValue(':email',  $contact->getEmail());
        $statement->execute();

        return $this->pdo->lastInsertId();
    }
}
