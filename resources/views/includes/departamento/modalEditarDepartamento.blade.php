<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-pencil-alt'></i> Editar Departamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="formularioEditar" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Departamento</label>
                        <input required type="text" class="form-control" id="nome_edit" name="nome_edit" placeholder="Informe o departamento">
                    </div>
                    <div class="form-group">
                        <label for="position">Chefe do Departamento</label>
                        <input required type="text" class="form-control" id="chefe_departamento" name="chefe_departamento" placeholder="Informe o chefe do departamento">
                    </div>
                    <div class="form-group">
                        <label for="company">E-mail</label>
                        <input required type="email" class="form-control" id="email" name="email" placeholder="Informe o email">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefone</label>
                                <input required type="number" class="form-control" id="telefone" name="telefone" placeholder="Informe o contacto telefónico" min="0">
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
                                    <input type="radio" value="Estudantil" name="tipo">
                                    <label for="tipo"> Estudantil </label>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <input type="hidden" class="form-control" id="id_departamento"  name="id_departamento">
                </div>
                <div class="modal-footer">
                    <button id="modalEditarClose" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Fechar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Actualizar</button>
                </div>
            </form> 
        </div>
    </div>
</div>