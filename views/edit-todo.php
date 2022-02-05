<?php
use Controllers\TodoController;

    $subtitle = $_SESSION[TodoController::TODO_NAME] ?? 'New todo';
    include 'views/layouts/header.php';
?>

<?php if (isset($_SESSION[TodoController::TODO_SUCCESS])) { ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div class="toast show align-items-center text-white bg-success opacity-75 border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $_SESSION[TodoController::TODO_SUCCESS] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (isset($_SESSION[TodoController::TODO_ERROR])) { ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show align-items-center text-white bg-danger opacity-75 border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $_SESSION[TodoController::TODO_ERROR] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } ?>

<nav class="navbar bg-light px-3 mb-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/todo">Todo</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= isset($oldValues) && isset($oldValues['name']) ? $oldValues['name'] : 'New'?></li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form
                    action="<?= isset($id) ? "/todo/$id/edit" : "/todo/add"; ?>"
                    method="post"
                    class="d-flex flex-column"
            >
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="form-control<?= isset($errors) && isset($errors['name']) ? ' is-invalid' : ''; ?>"
                        value="<?= isset($oldValues) && isset($oldValues['name']) ? $oldValues['name'] : ''; ?>"
                    >
                    <?php if (isset($errors) && isset($errors['name'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['name']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea
                        id="desc"
                        name="description"
                        class="form-control<?= isset($errors) && isset($errors['description']) ? ' is-invalid' : ''; ?>"
                    ><?= htmlspecialchars(isset($oldValues) && isset($oldValues['description']) ? $oldValues['description'] : ''); ?></textarea>
                    <?php if (isset($errors) && isset($errors['description'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['description']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="dueDate" class="form-label">Due date</label>
                    <input
                        id="dueDate"
                        type="datetime-local"
                        name="dueDate"
                        class="form-control<?= isset($errors) && isset($errors['dueDate']) ? ' is-invalid' : ''?>"
                        value="<?= isset($oldValues) && isset($oldValues['dueDate']) ? $oldValues['dueDate'] : ''; ?>"
                    >
                    <?php if (isset($errors) && isset($errors['dueDate'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['dueDate']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select
                        id="status"
                        name="status"
                        class="form-select<?= isset($errors) && isset($errors['status']) ? ' is-invalid' : ''?>"
                    >
                        <option value="ACTIVE" <?= isset($oldValues) && isset($oldValues['status']) && $oldValues['status'] === 'ACTIVE' ? 'selected' : ''; ?>>Active</option>
                        <option value="COMPLETED" <?= isset($oldValues) && isset($oldValues['status']) && $oldValues['status'] === 'COMPLETED' ? 'selected' : ''; ?>>Completed</option>
                    </select>
                    <?php if (isset($errors) && isset($errors['status'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['status']; ?>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

<?php
    include 'views/layouts/footer.php'
?>
