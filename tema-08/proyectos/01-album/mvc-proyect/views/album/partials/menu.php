<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>album">Albumes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['id_rol'], $GLOBALS['album']['new']) ? 'active' : 'disabled' ?>"
                        href="<?= URL ?>album/new">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                    <?= in_array($_SESSION['id_rol'], $GLOBALS['album']['order']) ? 'active' : 'disabled' ?>" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/2">Titulo</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/3">Descripción</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/4">Autor</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/5">Fecha</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/6">Categoría</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>album/order/7">Etiquetas</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>album/filter">
                <input class="form-control me-2" type="search" aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary
                <?= in_array($_SESSION['id_rol'], $GLOBALS['album']['filter']) ? null : 'disabled' ?>"
                    type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>