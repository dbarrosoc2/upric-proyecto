<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../../controllers/login-manage.php" method="post">
        <div class="form-group">
            <label for="user">Usuario o Correo:</label>
            <input type="text" name="user" id="user" class="form-control" placeholder="Usuario o Correo">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="pass" id="password" class="form-control" placeholder="Co ntraseña">
        </div>
        <button type="submit" class="btn btn-primary">Acceder</button>
    </form>
</body>

</html>