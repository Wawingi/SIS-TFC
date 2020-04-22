<div id="save-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Adicionar Sugestão</h4>
    <div class="custom-modal-text text-left">
        <form id="formularioSalvar" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Tema</label>
                <input required type="text" class="form-control" name="tema" placeholder="ex: SIS-TFC">
            </div>
            <!--Buscar area de aplicação na BD e preencher a combobox -->
            <?php 
                $areas = App\Model\Area::where('id_departamento',$sessao[0]->id_departamento)->get();
            ?>    
            <div class="form-group">
                <label for="position">Área de Aplicação</label>
                <select name="area" class="custom-select">
                    <?php foreach($areas as $area): ?>
                        <option>{{$area->nome}}</option>
                    <?php endforeach ?>
                </select>     
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" rows="5"></textarea>
            </div>
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
            </div>
        </form>
    </div>
</div>