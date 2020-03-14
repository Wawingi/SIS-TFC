<div id="save-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Adicionar Departamento</h4>
    <div class="custom-modal-text text-left">
        <form id="formularioSalvar" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Departamento</label>
                <input required type="text" class="form-control" name="nome" placeholder="ex: Ciências da Computação">
            </div>
            <div class="form-group">
                <label for="position">Chefe do Departamento</label>
                <input required type="text" class="form-control" name="chefe_departamento" placeholder="Informe o chefe do departamento">
            </div>
            <div class="form-group">
                <label for="company">E-mail</label>
                <input required type="email" class="form-control" name="email" placeholder="Informe o email">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefone</label>
                        <input required type="number" class="form-control" name="telefone" placeholder="Informe o contacto telefónico" min="0">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="genero">Tipo</label><br>
                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                            <input type="radio" value="Administrativo" name="tipo" checked>
                            <label for="tipo"> Administrativo </label>
                        </div>
                        <div class="radio form-check-inline">
                            <input type="radio" value="Estudantil" name="tipo" checked>
                            <label for="tipo"> Estudantil </label>
                        </div>
                    </div>
                </div> 
            </div>
            <input type="hidden" class="form-control" value="{{$sessao[0]->id_faculdade}}" name="id_faculdade">
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
            </div>
        </form>
    </div>
</div>