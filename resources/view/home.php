<div class="container">
    <? if (isset($_SESSION['user_id'])):?>
        <a href="/logout" class="btn btn-primary">Выйти</a>
    <? else:?>
        <a href="/auth" class="btn btn-primary">Войти</a>
    <? endif;?>
</div>

<div class="container">
    <table class="table table-bordered" id="tableTask" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Текст задачи</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Текст задачи</th>
                <th>Статус</th>
            </tr>
        </tfoot>
        <? foreach($data['tasks'] as $item): ?>
        <tr>
            <td>
                <?= $item['name_user']?>
            </td>
            <td>
                <?= $item['email']?>
            </td>
            <td>
                <?= $item['content']?>
            </td>
            <td>
                <p class="mb-0"><?= $item['done'] == 1 ? 'выполнено' : ''?></p>
                <p class="mb-0">
                    <?= $item['edit'] == 1 ? 'отредактировано администратором' : ''?>
                </p>
            </td>
        </tr>
        <? endforeach; ?>
    </table>
</div>

<div class="container mt-5">
    <form name="addTask" class="row">
        <div class="col-sm-3">
            <input type="text" class="form-control" name="Name" placeholder="Имя" required />
        </div>
        <div class="col-sm-3">
            <input type="email" class="form-control" name="Email" placeholder="Email" required />
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="Content" placeholder="Задача" required />
        </div>
        <button type="submit" class="btn btn-primary col-sm-3" height="50%">Добавить</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $("#tableTask").DataTable({
            "pageLength": 3,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
</script> 
<script>
    $("form[name='addTask']").submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "saveTask",
            data: $(this).serialize(),
            success: function () {
                alert('Успешно');
                document.location.reload(true);
            }
        });
    });
</script>

