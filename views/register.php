<?php
    $subtitle = 'Register';

    include 'layouts/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Register</h5>
            <form
                action="/auth/register"
                method="post"
                class="d-flex flex-column"
            >
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        id="username"
                        type="email"
                        name="username"
                        class="form-control"
                        placeholder="name@epoka.edu.al"
                    >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control<?= isset($errors) && isset($errors['password']) ? ' is-invalid' : ''?>"
                        value="<?= isset($oldValues) && isset($oldValues['confirmPassword']) ? $oldValues['password'] : ''; ?>"
                    >
                    <?php if (isset($errors) && isset($errors['password'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['password']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input
                            id="confirmPassword"
                            type="password"
                            name="confirmPassword"
                            class="form-control<?= isset($errors) && isset($errors['confirmPassword']) ? ' is-invalid' : ''?>"
                            value="<?= isset($oldValues) && isset($oldValues['confirmPassword']) ? $oldValues['confirmPassword'] : ''; ?>"
                    >
                    <?php if (isset($errors) && isset($errors['confirmPassword'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['confirmPassword']; ?>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <br>
                <a class="btn btn-outline-secondary" href="/auth/login" role="button" >Already have an account</a>
            </form>
        </div>
    </div>
</div>

<?php
    include 'layouts/footer.php';
?>