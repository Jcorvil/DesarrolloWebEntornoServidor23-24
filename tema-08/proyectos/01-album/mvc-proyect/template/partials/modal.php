<form action="<?= URL . 'album/add/' . $album->id ?>" method="post" enctype="multipart/form-data">
    <!-- Modal Subir Archivos -->
    <div id="add<?= $album->id ?>" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subir Archivos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!-- Campo oculto para la validación de tamaño máximo 5mb -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <input type="file" name="archivos[]" multiple="multiple" accept="image/*">
                        <!-- Mostrar posible error -->
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['error'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </div>
        </div>
    </div>
</form>