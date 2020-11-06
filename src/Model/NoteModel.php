<?php


namespace ToDoApp\Model;


use PDO;
use ToDoApp\Exception\NotFoundException;
use ToDoApp\Exception\StorageException;
use function ToDoApp\dump;

class NoteModel extends AbstractModel implements ModelInterface
{
    public function list(
        string $sortBy,
        string $sortOrder,
        string $pageSize,
        string $pageNumber
    ): array {

        $sortParam = $sortBy === 'date' ? 'created' : 'title';
        $offset = ($pageNumber - 1) * $pageSize;
        $limit = $pageSize;

        $sql = "SELECT id, title, created FROM notes ORDER BY $sortParam $sortOrder LIMIT $offset, $limit";

        $stmt = $this->db_conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search(
        string $phrase,
        string $sortBy,
        string $sortOrder,
        string $pageSize,
        string $pageNumber
    ): array {
        $phrase = $this->db_conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
        $sortParam = $sortBy === 'date' ? 'created' : 'title';
        $offset = ($pageNumber - 1) * $pageSize;
        $limit = $pageSize;
        $sql = "SELECT id, title, created FROM notes 
        WHERE title LIKE ($phrase)
        ORDER BY $sortParam $sortOrder LIMIT $offset, $limit";

        $stmt = $this->db_conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void
    {
        try {
            $title = $this->db_conn->quote($data['title']);
            $description = $this->db_conn->quote($data['description']);
            $created = $this->db_conn->quote(date("Y-m-d H:i:s"));
            $sql = "INSERT INTO notes (title, description, created) VALUES ($title, $description, $created)";
            $this->db_conn->exec($sql);
        } catch (\Throwable $e) {
            throw new StorageException("Nie udało się utworzyć notatki.");
        }
    }

    public function edit(array $data): void
    {
        try {
            $title = $this->db_conn->quote($data['title']);
            $description = $this->db_conn->quote($data['description']);
            $sql = "UPDATE notes SET title = $title, description = $description WHERE id = " . $data['id'];
            $this->db_conn->exec($sql);
        } catch (\Throwable $e) {
            throw new StorageException("Nie udało się edytować notatki");
        }
    }


    public function delete(int $id): void
    {
        try {
            $sql = "DELETE FROM notes WHERE notes.id = $id";
            $this->db_conn->exec($sql);
        } catch (\Throwable $e) {
            throw new StorageException("Nie udało się usunąć notatki", 400, $e);
        }
    }

    public function get(int $id): array
    {
        try {
            $sql = "SELECT * FROM notes WHERE notes.id = $id";
            $stmt = $this->db_conn->query($sql);
            $note = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($note)) {
                throw new NotFoundException("Notatka o id $id nie istnieje.");
            }
            return $note;
        } catch (\Throwable $e) {
            throw new StorageException("Nie udało się pobrać danych o notatce.", 400, $e);
        }
    }

    public function count(): int
    {
        try {
            $sql = "SELECT count(*) AS cn FROM notes";
            $stmt = $this->db_conn->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['cn'];
        } catch (\Throwable $e) {
            throw new StorageException("Problem z wyliczeniem notatek w bazie.", 400, $e);
        }
    }

    public function searchCount(string $phrase): int
    {
        try {
            $phrase = $this->db_conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
            $sql = "SELECT count(*) AS cn FROM notes WHERE title LIKE ($phrase)";
            $stmt = $this->db_conn->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['cn'];
        } catch (\Throwable $e) {
            throw new StorageException("Problem z wyliczeniem notatek po frazie.", 400, $e);
        }
    }
}
