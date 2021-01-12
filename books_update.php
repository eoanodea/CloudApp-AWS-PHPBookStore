<?php
require_once 'classes/Book.php';
require_once 'classes/Publisher.php';
require_once 'classes/Gump.php';
require_once 'utils/functions.php';

try {
    $validator = new GUMP();

    $_POST = $validator->sanitize($_POST);

    $validation_rules = array(
        'id' => 'required|integer|min_numeric,1',
        'title' => 'required|min_len,1|max_len,100',
        'author' => 'required|min_len,1|max_len,50',
        'isbn' => 'required|alpha_numeric|exact_len,13',
        'year' => 'required|numeric|exact_len,4|min_numeric,1900',
        'price' => 'required|float|min_numeric,0',
        'publisher_id' => 'required|integer|min_numeric,1'
    );
    $filter_rules = array(
    	'id' => 'trim|sanitize_numbers',
        'title' => 'trim|sanitize_string',
        'author' => 'trim|sanitize_string',
        'isbn' => 'trim|sanitize_string',
        'year' => 'trim|sanitize_numbers',
        'price' => 'trim|sanitize_floats',
        'publisher_id' => 'trim|sanitize_numbers'
    );

    $validator->validation_rules($validation_rules);
    $validator->filter_rules($filter_rules);
    
    $validated_data = $validator->run($_POST);
    
    

    if($validated_data === false) {
        $errors = $validator->get_errors_array();
    }
    else {
        $errors = array();

        $publisher_id = $validated_data['publisher_id'];
        
        $publisher = Publisher::find($publisher_id);
        
        if ($publisher === false) {
            $errors['publisher_id'] = "Invalid publisher";
        }

        // dd($_FILES);
        // dd($validated_data);
        
        if (isset($validated_data['cover'])) {
          try {
              $coverImageFile = imageFileUpload('cover', false, 1000000, array('jpg', 'jpeg', 'png', 'gif'));
          }
          catch (Exception $e) {
              $errors['cover'] = $e->getMessage();
          }
        }

        
    }
    
// dd($errors);
    if (!empty($errors)) {
        throw new Exception("There were errors. Please fix them.");
    }
    

    $id = $validated_data['id'];
    $book = Book::find($id);
    $book->title = $validated_data['title'];
    $book->author = $validated_data['author'];
    $book->isbn = $validated_data['isbn'];
    $book->year = $validated_data['year'];
    $book->price = $validated_data['price'];
    $book->publisher_id = $validated_data['publisher_id'];
    if ($coverImageFile != null) {
        if ($book->cover != null && $book->cover != 'uploads/book_default.png' && file_exists($book->cover)) {
            unlink($book->cover);
        }
        $book->cover = $coverImageFile;
    }
    $book->save();

    header("Location: books_index.php");
}
catch (Exception $ex) {
  dd();
    require 'books_edit.php';
}
?>
