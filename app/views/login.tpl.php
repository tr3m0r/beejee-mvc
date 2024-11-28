<?php include_once __DIR__ . '/chunks/header.tpl.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 col-sm-4">
            <h1>Авторизация</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 col-sm-4">
            <form action="/user/login" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> На главную</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-key"></i> Войти</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/chunks/footer.tpl.php' ?>