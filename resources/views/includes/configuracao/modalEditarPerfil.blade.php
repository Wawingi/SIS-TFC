<div class="modal fade editar" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div style="background-color:#3bafda;color:white" class="modal-header">
                <h4 style="color:white" class="modal-title" id="myCenterModalLabel"><i class='fa fa-pencil-alt'></i> Actualizar Perfil de Utilizador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formularioEditar" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input required type="text" class="form-control" id="nome_edit" name="nome_edit">
                    </div>
                    <div class="form-group">
                        <label for="name">Descrição</label>
                        <input required type="text" class="form-control" id="desc_edit" name="desc_edit">
                    </div> 
                    <input required type="hidden" class="form-control" id="id_edit" name="id_edit">    
                    <hr>
                    <div class="text-right">
                        <button id="modalEditarClose" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>