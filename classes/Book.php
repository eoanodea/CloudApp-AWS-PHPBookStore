<?php
require_once 'classes/Connection.php';

class Book {
    public $id;
    public $title;
    public $author;
    public $isbn;
    public $year;
    public $price;
    public $cover;
    public $publisher_id;

    public function __construct() {
    }

    public function save() {
        $params = array(
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'year' => $this->year,
            'price' => $this->price,
            'cover' => $this->cover,
            'publisher_id' => $this->publisher_id
        );

        if ($this->id === NULL) {
            $sql = "INSERT INTO books(
                        title, author, isbn, year, price, cover, publisher_id
                    ) VALUES (
                        :title, :author, :isbn, :year, :price, :cover, :publisher_id
                    )";
        }
        else if ($this->id !== NULL) {
            $params["id"] = $this->id;

            $sql = "UPDATE books SET
                        title = :title,
                        author = :author,
                        isbn = :isbn,
                        year = :year,
                        price = :price,
                        cover = :cover,
                        publisher_id = :publisher_id
                    WHERE id = :id";
        }

        $conn = Connection::getInstance();
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to save book");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error saving book");
            }
            if ($this->id === NULL) {
                $this->id = $conn->lastInsertId('books');
            }
        }
    }

    public function delete() {
        if (empty($this->id)) {
            throw new Exception("Unsaved book cannot be deleted");
        }
        $params = array(
            'id' => $this->id
        );
        $sql = 'DELETE FROM books WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to delete book");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error deleting book");
            }
        }
    }

    public static function all() {
        $sql = 'SELECT * FROM books';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }

    public static function find($id) {
        $params = array(
            'id' => $id
        );
        $sql = 'SELECT * FROM books WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve book");
        }
        else {
            $book = $stmt->fetchObject('Book');
            return $book;
        }
    }
}
?>
