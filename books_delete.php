<?php
require_once 'classes/Book.php';
require_once 'classes/Publisher.php';
require_once 'classes/Gump.php';

try {
    $validator = new GUMP();

    $_GET = $validator->sanitize($_GET);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);

    $validated_data = $validator->run($_GET);

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
        throw new Exception("Invalid book id: " . $errors['id']);
    }

    $id = $validated_data['id'];
    $book = Book::find($id);
    if ($book->cover != null && $book->cover != 'uploads/book_default.png' && file_exists($book->cover)) {
        unlink($book->cover);
    }
    $book->delete();

    header("Location: books_index.php");
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>
