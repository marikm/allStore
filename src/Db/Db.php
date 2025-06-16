<?php
namespace App\Db;

class Db {
    protected \PDO $db;

    public function __construct(string $user = "root", string $password = "", string $host = "localhost", string $dbname = "allstore")
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $this->db = new \PDO($dsn, $user, $password);
    }

    public function getAll(string $table): array
    {
        $sql = "SELECT * FROM $table";
        $data = $this->executeQuery($sql)->fetchAll(\PDO::FETCH_OBJ);
        $result = [];
        foreach($data as $line) {
            $itemAsArray = (array) $line;

            $result[$itemAsArray['name']] = $itemAsArray;
        }

        return $result;
    }

    public function getTable(string $table): array {
        $sql = "SELECT * FROM $table";
        $data = $this->executeQuery($sql)->fetchAll(\PDO::FETCH_OBJ);

        return $data;
    }

    public function getFieldId(string $table, $id, $field): array {
        $sql = "SELECT $id, $field FROM $table";
        $data = $this->executeQuery($sql)->fetchAll(\PDO::FETCH_OBJ);

        return $data;
    }

    public function getTableByUser(string $table, string $user): array {
        $sql = "SELECT * FROM $table WHERE nome = :user";
        $data = $this->executeQuery($sql, [':user' => $user])->fetchAll(\PDO::FETCH_OBJ);

        return $data;
    }

    public function getOne(int $id, string $table, $field = 'id'): array
    {
        $sql = "SELECT * FROM $table WHERE $field = :id";
        return $this->executeQuery($sql, [':id' => $id])->fetch(\PDO::FETCH_ASSOC);
    }

    public function getOneUser(string $nome, string $table): array
    {
        $sql = "SELECT * FROM $table WHERE nome = :nome";
        return $this->executeQuery($sql, [':nome' => $nome])->fetch(\PDO::FETCH_ASSOC);
    }

    public function checkIfIdExists(int $id, string $table): bool {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->executeQuery($sql, [':id' => $id])->fetch();
        return $stmt->rowCount() > 0;
    }

    public function insert(string $fields, string $values, string $table): bool
    {
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        return $this->executeNonQuery($sql);
    }

    public function update(int $id, string $fields, string $values, string $table, $id_name = 'id'): bool
    {
        $sql = "UPDATE $table SET $fields = $values WHERE $id_name = :id";
        return $this->executeNonQuery($sql, [':id' => $id]);
    }

    public function delete(int $id, string $table,  $id_name = 'id'): bool
    {
        $sql = "DELETE FROM $table WHERE $id_name = :id";
        return $this->executeNonQuery($sql, [':id' => $id]);
    }

    public function genericSelect(string $fields, string $table): array
    {
        $sql = "SELECT $fields FROM $table";
        return $this->executeQuery($sql)->fetchAll();
    }

    public function genericSelectWhere(string $fields, string $table, string $where): array
    {
        $sql = "SELECT $fields FROM $table WHERE $where";
        return $this->executeQuery($sql)->fetchAll();
    }
    //
    // Ambos são metodos que vão executar uma sentença sql
    // o nonquery vai ser executado quando houver processamento no servidor
    // o query é para qnd fazer apenas um select
    //
    private function executeQuery(string $sql, array $params = []): \PDOStatement
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query;
    }

    private function executeNonQuery(string $sql, array $params = []): bool
    {
        $query = $this->executeQuery($sql, $params);
        return $query->rowCount() > 0;
    }

}