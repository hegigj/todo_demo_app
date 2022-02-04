<?php
    $subtitle = 'My Todos';
    include 'views/layouts/header.php';
?>

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

<?php
    include 'views/layouts/paginator.php';
    include 'views/layouts/footer.php';
?>
