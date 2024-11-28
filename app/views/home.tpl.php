<?php include_once __DIR__ . '/chunks/header.tpl.php'; ?>

    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto me-auto">
                <h1>Список задач</h1>
            </div>

            <div class="col-auto">
                <?php /*if ($user) {*/ ?>
                    <a href="/user/logout" class="btn btn-outline-danger">Выход <i class="bi bi-door-open"></i></a>
                <?php /*} else {*/ ?>
                    <a href="/user/login" class="btn btn-outline-secondary"><i class="bi bi-key"></i> Авторизация</a>
                <?php /*}*/ ?>
            </div>
        </div>

        <?php include_once __DIR__ . "/chunks/task_grid.tpl.php" ?>

        <div class="row justify-content-between">
            <div class="col-auto me-auto">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php if(isset($data['current_page']) && $data['current_page'] > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="/page/1" aria-label="Первая">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/page/<?= $data['current_page'] - 1; ?>" aria-label="Предыдущая">
                                    <span aria-hidden="true">&lsaquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <span class="page-link" aria-label="Первая">
                                    <span aria-hidden="true">&laquo;</span>
                                </span>
                            </li>
                            <li class="page-item disabled">
                                    <span class="page-link" aria-label="Предыдущая">
                                        <span aria-hidden="true">&lsaquo;</span>
                                    </span>
                            </li>
                        <?php endif; ?>

                        <?php if (!empty($data['total_pages'])): ?>
                            <?php for($i = 1; $i <= $data['total_pages']; $i++) : ?>
                                <?php if (isset($data['current_page']) && $data['current_page'] == $i): ?>
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link"><?= $i; ?></span>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="/page/<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <?php if(isset($data['current_page']) && $data['current_page'] < $data['total_pages']) : ?>
                            <li class="page-item">
                                <a class="page-link" href="/page/<?= $data['current_page'] + 1; ?>" aria-label="Следующая">
                                    <span aria-hidden="true">&rsaquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="/page/<?= $data['total_pages']; ?>" aria-label="Последняя">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                    <span class="page-link" aria-label="Следующая">
                                        <span aria-hidden="true">&rsaquo;</span>
                                    </span>
                            </li>
                            <li class="page-item disabled">
                                <span class="page-link" aria-label="Последняя">
                                    <span aria-hidden="true">&raquo;</span>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskAdd"><i class="bi bi-plus-circle"></i> Добавить задачу</button>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="taskAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="" class="modal-content" id="newTaskForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Новая задача</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">                   
                        <div class="mb-3">
                            <label for="taskUsrName" class="form-label">Имя пользователя</label>
                            <input type="text" class="form-control" id="taskUsrName" name="user_name">
                        </div>

                        <div class="mb-3">
                            <label for="taskUsrEmail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="taskUsrEmail" placeholder="name@beejee.org" name="user_email">
                        </div>

                        <div class="mb-3">
                            <label for="taskDesc" class="form-label">Задача</label>
                            <textarea class="form-control" id="taskDesc" rows="3" name="task_description"></textarea>
                        </div>

                        <?php if ($user) { ?>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="completed" <?php if($task['completed']) : ?>checked<?php endif; ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Задача выполнена
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>

<?php include_once __DIR__ . '/chunks/footer.tpl.php' ?>