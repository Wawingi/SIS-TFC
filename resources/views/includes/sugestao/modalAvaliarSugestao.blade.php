<div id="save-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Rejeitar a Proposta</h4>
    <div class="custom-modal-text text-left">
        <form action='{{ url("rejeitarProposta")}}' id="formularioSalvarrrr" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Informe o motivo</label>
                <textarea class="form-control" name="descricao" rows="3"></textarea>
            </div>
            <input type="hidden" name="idSugestao" value="{{$sugestao[0]->id}}">     
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>OK</button>
            </div>
        </form>
    </div>
</div>