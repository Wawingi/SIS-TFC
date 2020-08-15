<div class="modal fade editar bs-example-modal-lg" id="modalRejeitar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-pencil-alt mr-2'></i>Rejeitar a Proposta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="formularioSalvar" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Informe o motivo</label>
                        <textarea class="form-control" name="descricao" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="idSugestao" value="{{$sugestao[0]->id}}">     
                    <input type="hidden" name="proveniencia" value="{{$sugestao[0]->proveniencia}}">     
                </div>
                <div class="modal-footer">
                    <button id="modalRejeitarClose" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Fechar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                </div>
            </form>
        </div>
    </div>
</div>