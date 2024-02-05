<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="<?= URL ?>perfil">Mostrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= URL ?>perfil/edit">Editar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= URL ?>perfil/pass">Cambiar Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= URL ?>perfil/delete" onclick="return confirm('Confimar eliminación de su perfil')">Eliminar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>