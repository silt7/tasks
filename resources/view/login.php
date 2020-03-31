<div class="container mt-5" >
    <form class="border w-50 m-auto p-5" name="Login">
        <div class="form-group">
            <input type="text" class="form-control" name="Login" placeholder="Логин" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="Password" placeholder="Пароль" required />
        </div>
        <button type="submit" class="btn btn-primary col-sm-3 float-right" height="50%">Войти</button>
    </form>
</div>
<script>
    $("form[name='Login']").submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "login",
            data: $(this).serialize(),
            success: function (data) {
                if (data['response'] == 'err') {
                    alert('Неправильно введён логин или пароль');
                }
                else {
                    document.location.reload(true);
                }
            }
        });
    });
</script>
