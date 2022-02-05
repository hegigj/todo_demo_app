<?php
    $subtitle = 'My Todos';

    include 'views/layouts/header.php';
?>

<div class="container-fluid p-3">
    <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-primary" href="/todo/add" role="button">Add new todo</a>
    </div>
    <ol class="list-group list-group-numbered">
        <?php foreach ($todoList as $todo) { ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">
                        <a href="/todo/<?= $todo['id'] ?>"><?= $todo['name'] ?></a> | <?= date('d/m/Y H:i', strtotime($todo['dueDate'])) ?>
                    </div>
                    <?= $todo['description'] ?>
                </div>
                <span class="badge rounded-pill<?= $todo['status'] === 'ACTIVE' ? ' bg-primary' : ' bg-success' ?>"><?= $todo['status'] ?></span>
            </li>
        <?php } ?>
    </ol>
</div>

<?php
    include 'views/layouts/paginator.php';
    include 'views/layouts/footer.php';
?>
