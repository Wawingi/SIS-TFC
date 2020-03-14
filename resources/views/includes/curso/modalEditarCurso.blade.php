<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-pencil-alt'></i> Editar Curso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="formularioEditar" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Curso</label>
                        <input required type="text" class="form-control" id="nome_edit" name="nome_edit" placeholder="Informe o curso">
                    </div>
                    <input reuired type="hidden" class="form-control" id="id_curso"  name="id_curso">
                </div>
                <div class="modal-footer">
                    <button id="modalEditarClose" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Fechar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Actualizar</button>
                </div>
            </form> 
        </div>
    </div>
</div>