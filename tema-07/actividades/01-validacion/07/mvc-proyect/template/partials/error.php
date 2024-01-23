<?php if (isset($this->error)): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
                <strong>ERROR: </strong>
                <?= $this->error; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php endif; ?>