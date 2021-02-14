<div class="modal fade" id="modalElemento" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Elemento</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPretextual" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input required type="text" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Anexar Ficheiro em Pdf</label>
                        <input required type="file" class="form-control" accept="application/pdf" name="descricao">
                        <span style="color:red;font-style:italic">tamanho máximo 2Mb</span>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>