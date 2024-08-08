<?php

$title = 'ピッツェリア インタープラン';

$num = strrpos($_SERVER['REQUEST_URI'], '/');
$filename = substr($_SERVER['REQUEST_URI'], $num + 1);

switch ($filename) {
  case 'add.php':
    $title = 'ピザの登録';
    break;
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

  <header>
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container-fluid">
        <a class="navbar-brand" href="pizza.php">ピッツェリアインタープラン</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="active btn btn-primary" aria-current="page" href="add.php">ピザの登録</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </header>