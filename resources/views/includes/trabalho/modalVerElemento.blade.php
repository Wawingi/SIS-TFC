<div class="modal fade modalVerElemento bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-eye mr-2'></i>Ver Elemento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="name">Data de registo</label>
                        <input type="text" style="background:#f5f6f8" class="form-control form-control-sm" readonly id="data_registo" name="data_registo"/>
                    </div>
                    <div class="col-6 form-group">
                        <label for="name">Data de avaliação</label>
                        <input type="text" style="background:#f5f6f8" class="form-control form-control-sm" readonly id="data_avaliacao" name="data_avaliacao"/>
                    </div>
                    <div class="col-12 form-group">
                        <label for="name">Comentário</label>
                        <textarea class="form-control form-control-sm" style="background:#f5f6f8" readonly id="comentario" name="comentario"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" style="display:none;background:#f5f6f8" readonly rows="5" id="predefinidas" name="predefinidas"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>