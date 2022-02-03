<?php
    $subtitle = 'Login';

    include 'layouts/header.php';
?>

<div class="container-fluid">
    <div class="card"">
        <div class="card-body">
            <h5 class="card-title">Login</h5>
            <form
                    action="/auth/login"
                    method="post"
                    class="d-flex flex-column"
            >
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                            id="username"
                            type="email"
                            name="username"
                            class="form-control<?= isset($_SESSION['errors']) && isset($_SESSION['errors']['username']) ? ' is-invalid' : ''; ?>"
                            placeholder="name@epoka.edu.al"
                            value="<?= isset($_SESSION['oldValues']) ? $_SESSION['oldValues']['username'] : ''; ?>"
                    >
                    <?php if (isset($_SESSION['errors']) && isset($_SESSION['errors']['username'])) { ?>
                        <div class="invalid-feedback">
                            <?= $_SESSION['errors']['username']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control<?= isset($_SESSION['errors']) && isset($_SESSION['errors']['password']) ? ' is-invalid' : ''?>"
                            value="<?= isset($_SESSION['oldValues']) && $_SESSION['oldValues'] ? $_SESSION['oldValues']['password'] : ''; ?>"
                    >
                    <?php if (isset($_SESSION['errors']) && isset($_SESSION['errors']['password'])) { ?>
                        <div class="invalid-feedback">
                            <?= $_SESSION['errors']['password']; ?>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <br>
                <a class="btn btn-outline-secondary" href="/auth/register" role="button" >Create account</a>
            </form>
        </div>
    </div>
</div>

<?php
    include 'layouts/footer.php';
?>