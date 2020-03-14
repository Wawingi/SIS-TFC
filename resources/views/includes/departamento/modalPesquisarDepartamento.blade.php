<div id="pesquisaDPTO-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Pesquisar Departamento</h4>
    <div class="custom-modal-text text-left">
        <form id="formularioPesquisar" action="{{ url('pesquisarDepartamento') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input required type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome do departamento">
            </div>
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-file-search-outline mr-1"></i>Pesquisar</button>
            </div>
        </form>
    </div>
</div>