<!-- Import Modal -->
<div class="modal fade" id="importModalCuentas" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Importar Archivo CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URL ?>cuentas/import" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="archivo_csv" class="form-label">Seleccionar archivo CSV</label>
                        <input type="file" class="form-control" id="archivo_csv" name="archivo_csv" accept=".csv">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>