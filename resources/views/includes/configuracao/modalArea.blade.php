<div id="save-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Adicionar Área de Aplicação</h4>
    <div class="custom-modal-text text-left">
        <form id="formularioSalvar" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="ex: Inovação Tecnológica">
            </div>     
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
            </div>
        </form>
    </div>
</div>