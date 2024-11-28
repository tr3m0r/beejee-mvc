<table class="table">
    <thead>
        <tr>
            <!--
            <th scope="col"><?php /*echo sort_link_th('Имя пользователя', 'sort_user_name_asc', 'sort_user_name_desc');*/ ?></th>
            <th scope="col"><?php /*echo sort_link_th('e-mail', 'sort_user_email_asc', 'sort_user_email_desc');*/ ?></th>
            <th scope="col">Задача</th>
            <th scope="col"><?php /*echo sort_link_th('Статус', 'sort_completed_asc', 'sort_completed_desc');*/ ?></th>
            -->
            <th scope="col"><?php echo $sort; ?></th>
            <?php if ($user) { ?>
                <th scope="col"></th>
            <?php } ?>
        </tr>
    </thead>
<?php
    /*if(!empty($data['tasks'])) {
      print_r($data);
    } else {
        echo 'нет массива';
    }*/
?>
    <tbody>
        <?php if (!empty($data['tasks'])): ?>
            <?php foreach($data['tasks'] as $task) : ?> 
                <tr>
                    <td><?= $task['user_name']; ?></td>
                    <td><?= $task['user_email']; ?></td>
                    <td class="fdgdfg"><?= $task['task_description']; ?></td>
                    <td>
                        <?php switch ($task['completed']): case '0': ?>
                            <span class="badge text-bg-primary">Новая</span>
                            <?php break;?>
                        <?php case '1': ?>
                            <span class="badge text-bg-success">Выполнена</span>
                            <?php break;?>
                        <?php endswitch; ?>
                        
                        <?php if ($task['edited'] == 1) { ?>
                            <span class="badge text-bg-info">Отредактировано администратором</span>
                        <?php } ?>
                    </td>
                    <?php if ($user) { ?>
                        <td>
                            <div class="text-end">
                                <a class="icon-link" href="#" data-bs-toggle="modal" data-bs-target="#taskEdit<?= $task['id']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>

                            <div class="modal fade" id="taskEdit<?= $task['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="update.php" class="modal-content">
                                        <input type="hidden" name="id" value="<?= $task['id']; ?>">
                                        <input type="hidden" name="edited" value="1">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование задачи</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">                   
                                            <div class="mb-3">
                                                <label for="taskUsrName" class="form-label">Имя пользователя</label>
                                                <input type="text" class="form-control" id="taskUsrName" name="user_name" value="<?= $task['user_name']; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="taskUsrEmail" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="taskUsrEmail" placeholder="name@beejee.org" name="user_email" value="<?= $task['user_email']; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="taskDesc" class="form-label">Задача</label>
                                                <textarea class="form-control" id="taskDesc" rows="3" name="task_description"><?= $task['task_description']; ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="completed" <?php if($task['completed']) : ?>checked<?php endif; ?>>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Задача выполнена
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>