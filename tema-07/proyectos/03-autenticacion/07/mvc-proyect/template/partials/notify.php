<?php if (isset($this->mensaje)): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
                <strong>ALERTA: </strong>
                <?= $this->mensaje; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php endif; ?>