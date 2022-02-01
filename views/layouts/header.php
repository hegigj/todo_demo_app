<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo<?= $subtitle ? " | $subtitle" : "" ?>></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Todo App</span>
    </div>
</nav>
<header class="app-header">
    <h1>Todo App</h1>
    <?php if (isset($_SESSION['username'])) { ?>
        <div class="user-section">
            <span><?= $_SESSION['username'] ?></span>
            <form action="/auth/logout" method="post">
                <button>Logout</button>
            </form>
        </div>
    <?php } ?>
</header>