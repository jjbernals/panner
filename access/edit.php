<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
    header('Location: login.php'); // Redirige al usuario si no ha iniciado sesión
    exit();
}

include_once 'modelo/editar_modelo.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = new Task();
    $task ->update($id);
    $rows = $task->select($id); // Obtiene los datos de la tarea
} else {
    echo "ID no válido.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Pagina</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/estilos.css">
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Editar Pagina</a>
</nav>

<div class="container pt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Pagina</h4>
                </div>
                <?php if (!empty($rows)) {
                    foreach ($rows as $row) { ?>
                        <form action="" method="post" class="card-body">
                            <div class="form-group">
                                <input type="text" name="titlePostEdit"
                                       placeholder="Task Title" class="form-control"
                                       value="<?php echo htmlspecialchars($row['url']); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="descPostEdit"
                                       placeholder="Task Title" class="form-control"
                                       value="<?php echo htmlspecialchars($row['estado']); ?>">
                            </div>
                            <div class="form-group">
                                <input type="date" name="fecha"
                                       placeholder="Task Title" class="form-control"
                                       value="<?php echo htmlspecialchars($row['ultimo_chequeo']); ?>">
                            </div>
                            <input type="submit" value="Actualizar" name="updateBtn"
                                   class="btn btn-success btn-block">
                        </form>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
