<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>cuentas">Cuentas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>cuentas/new"> Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/1">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/2">Nº de cuenta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/3">Cliente</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/4">Fecha alta</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/5">Fecha último movimiento</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/6">Movimientos totales</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>cuentas/order/7">Saldo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['export'])) ? 'disabled' : '' ?>"
                        href="<?= URL ?>cuentas/export"
                        onclick="return confirm('Se va a proceder a la exportación de los datos. ¿Desea continuar?')">
                        Exportar</a>
                </li>
                <li class="nav-item">
                    <button type="button"
                        class="nav-link btn btn-link <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['import'])) ? 'disabled' : '' ?>"
                        data-bs-toggle="modal" data-bs-target="#importModalCuentas">Importar</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>cuentas/pdf">Generar PDF</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?= URL ?>cuentas/filter">
                <input class="form-control me-2" type="search" aria-label="Search" name="expresion">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>