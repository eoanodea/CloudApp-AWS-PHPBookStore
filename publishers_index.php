<?php
require_once 'classes/Publisher.php';

try {
    $publishers = Publisher::all();
}
catch (Exception $ex) {
    die($ex->getMessage());
}
?><!DOCTYPE html>
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
                    <h2>Publishers</h2>
                    <?php if (count($publishers) == 0) { ?>
                        <p>There are no publishers</p>
                    <?php } else { ?>
                        <table id="table-publishers" class="table table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Website</th>
                            </thead>
                            <tbody>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <tr data-id="<?= $publisher->id ?>">
                                        <td><?= $publisher->name ?></td>
                                        <td><?= $publisher->address ?></td>
                                        <td><?= $publisher->phone ?></td>
                                        <td><?= $publisher->email ?></td>
                                        <td><?= $publisher->website ?></td>
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
