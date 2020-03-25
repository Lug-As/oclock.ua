<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $desc; ?>">
    <meta name="keywords" content="<?= implode(", ", $keywords); ?>">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Default</h1>
        <?= $content; ?>
        <?php debug($name, 'name'); ?>
        <?php debug($age, 'age'); ?>
    </div>

<?php
    getRlogs();
?>
</body>
</html>