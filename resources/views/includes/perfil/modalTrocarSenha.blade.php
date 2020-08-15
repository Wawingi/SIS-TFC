<div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"><i class="fas fa-user-lock mr-2"></i>Alterar Senha</h4>
                <button id="modalCloseAlterar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="trocarSenha" method="post"> 
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="senha">Informe a senha actual</label>
                                    <input type="password" class="form-control" name="senhaactual" id="senhaactual" placeholder="Senha actual">                                              
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label>Informe a nova senha</label>
                                    <input type="password" class="form-control" name="novasenha" id="novasenha" placeholder="Nova senha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label>Confirmar nova senha</label>
                                    <input type="password" class="form-control" name="confirmarsenha" id="confirmarsenha" placeholder="Confirmar a nova senha">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form> 
            </div>               
        </div>
    </div>
</div>