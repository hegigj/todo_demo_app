<?php
use Controllers\TodoController;

    $subtitle = $_SESSION[TodoController::TODO_NAME] ?? '';
    include 'views/layouts/header.php';
?>

<p>edit-todo works !</p>
<pre>
    <?php var_dump($todo); ?>
</pre>

<?php
    include 'views/layouts/footer.php'
?>
