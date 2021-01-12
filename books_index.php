<?php
require_once 'classes/Book.php';
require_once 'classes/Publisher.php';

try {
    $books = Book::all();
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php require 'utils/header.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php require 'utils/toolbar.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Books <a href="books_create.php" class="btn btn-primary pull-right">Add</a></h2>
                    <?php if (count($books) == 0) { ?>
                        <p>There are no books</p>
                    <?php } else { ?>
                        <table id="table-books" class="table table-hover">
                            <thead>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Publisher</th>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book) { ?>
                                    <tr data-id="<?= $book->id ?>">
                                        <td><a href="books_show.php?id=<?= $book->id ?>" class="btn-link"><?= $book->title ?></a></td>
                                        <td><?= $book->author ?></td>
                                        <td><?= $book->isbn ?></td>
                                        <td><?= $book->year ?></td>
                                        <td><?= $book->price ?></td>
                                        <td><?= Publisher::find($book->publisher_id)->name ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php require 'utils/footer.php'; ?>
                </div>
            </div>
        </div>
    </body>
</html>
