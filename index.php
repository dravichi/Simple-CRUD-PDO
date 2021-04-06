<?php
$conn = require_once 'Connection.php';

$notes = $conn->read();

$currentNote = [
    'title' => '',
    'description' => '',
    'id' => ''
];

if (isset($_POST['id'])) {
    $currentNote = $conn->getNoteById($_POST['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="text-center w-50 mx-auto">
            <h1 class="display-6 mt-4 mb-4"><b>NOTES</b></h1>
            <form method="post" action="save.php">
                <div class="form-row align-items-center">
                    <input type="hidden" name="id" value="<?= $currentNote['id'] ?>">
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="title" placeholder="Title..." autocomplete="off" value="<?= $currentNote['title'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Description..." autocomplete="off"><?= $currentNote['description'] ?></textarea>
                </div>
        </div>
        <div class="col text-center">
            <button class="btn btn-primary">
                <?php if (isset($_POST['id'])) {
                    echo "UPDATE!";
                } else {
                    echo "CREATE!";
                } ?>
            </button>
        </div>
    </div>
    </form>
    </div>
    <?php foreach ($notes as $note) : ?>
        <div class="card text-center w-50 mx-auto mt-3">
            <h5 class="card-header"><?= $note['datetime'] ?></h5>
            <div class="card-body">
                <h5 class="card-title"><?= $note['title'] ?></h5>
                <p class="card-text"><?= $note['description'] ?></p>
                <form action="index.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                    <button class="btn btn-warning">Update</button>
                </form>
                <form action="delete.php" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</body>

</html>