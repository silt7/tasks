<div class="container">
    <? if (isset($_SESSION['user_id'])):?>
    <a href="/" class="btn btn-outline-secondary">Home</a>
    <a href="/logout" class="btn btn-primary">Выйти</a>
    <? else:?>
    <a href="/auth" class="btn btn-primary">Войти</a>
    <? endif;?>
</div>
<div class="container mt-2">
    <table class="table table-bordered" id="tableTask" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Контент</th>
                <th>Выполнено</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Контент</th>
                <th>Выполнено</th>
                <th></th>
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
                <input type="text" name="content" value="<?= $item['content']?>" />   
            </td>
            <td>
                <input type="checkbox" name="done" <?= $item['done'] == 1 ? 'checked' : '';?> />
            </td>
            <td>
                <a id="<?= $item['id']?>" name="b_save" class="btn btn-primary">Сохранить</a>
            </td>
        </tr>
        <? endforeach; ?>
    </table>
</div>

<script>
    $('a[name="b_save"]').click(function (event) {
        event.preventDefault();

        tr = $(this).closest('tr');
        var data = new Object();
        data.id = $(this).prop('id');
        data.content = tr.find('input[name="content"]').val();
        data.done = tr.find('input[name="done"]').prop('checked');

        console.log(JSON.stringify(data));
        $.ajax({
            type: "POST",
            url: "edit",
            data: data,
            success: function () {
                alert('Сохранено');
            },
            error: function (request, status, error) {
                alert('Ошибка');
                document.location.reload(true);
            }
        });
    });
</script>
