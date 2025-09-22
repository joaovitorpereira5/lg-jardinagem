<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="card">
    <div class="card-header">
        <h3>Administradores</h3>
    </div>
    <form method="POST" action="../src/routes/LoginRoutes.php">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Email</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['listarAdmins'])):
                        foreach ($_SESSION['listarAdmins'] as $admin): ?>
                            <tr>

                                <td><?php echo htmlspecialchars($admin['email']); ?></td>

                            </tr>
                        <?php endforeach;
                   endif ?>
                </tbody> 
            </table>
            <input type="hidden" name="action" value="listarAdmins">
            <button type="submit" class="btn btn-primary m-3">Listar Administradores</button>
        </div>          
    </form>
</div>

<br><br><br>


 <div class="card">
     <div class="card-header">
        <h3>Usuários Cadastrados</h3>
     </div>
     <form method="POST" action="../src/routes/LoginRoutes.php">

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Email</th>

                    </tr>
                </thead>
                <tbody>


                    <?php
                    if (!empty($_SESSION['listarUsuarios'])):
                        foreach ($_SESSION['listarUsuarios'] as $usuario): ?>
                            <tr>

                                <td><?php echo htmlspecialchars($usuario['email']); ?></td>

                            </tr>
                        <?php endforeach;
                    endif ?>
                </tbody>


            </table>
            <input type="hidden" name="action" value="listarUsuarios">
            <button type="submit" class="btn btn-primary m-3">Listar Usuários</button>
        </div>

    </form>
 </div>