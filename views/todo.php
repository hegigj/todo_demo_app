<?php
    $subtitle = 'My Todos';
    include 'views/layouts/header.php';
?>

<ul>
    <?php foreach ($todoList as $todo) { ?>
        <li style="cursor: pointer"><?= $todo['name'] ?></li>
    <?php } ?>
</ul>

<?php
    include 'views/layouts/footer.php';
?>
