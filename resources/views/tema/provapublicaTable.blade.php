    <tr>
        <td colspan="6"><span style="text-align:center;font-weight:bold"><i class="fas fa-tasks mr-1"></i>DADOS DA PROVA PÚBLICA</span>@can('apagar_global_tutor')<a href="#" id_prova="{{$provapublica->id}}" class="eliminarProvaPublica float-right btn btn-danger btn-sm btn-rounded"><i class='fa fa-trash-alt mr-2'></i>Eliminar</a>@endcan</td>
    </tr>
    <tr>
        <td colspan="6"><hr style="margin-top:-20px"></td>
    </tr>
    <tr>                
        <td style="background:#edeff1">Data da defesa</td>                
        <td><a href="#" class="dataprovapublica_edit" data-name="created_at" data-type="combodate" data-value="{{$provapublica->data_defesa}}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="DD/MM/YYYY" data-pk="{{$provapublica->id}}"></a></td>                
        <td style="background:#edeff1">Presidente</td>                
        <td><B>{{$provapublica->presidente}}</B></td>    
        <td style="background:#edeff1">Secretário</td>                
        <td><B>{{$provapublica->secretario}}</B></td>   
    </tr>                
    <tr>                
        <td style="background:#edeff1">Nota do trabalho</td>                
        <td><a href="#" class="nota_edit" data-name="nota" data-type="number" data-min="0" data-max="20" data-placeholder="Preenchimento obrigatório" data-pk="{{$provapublica->id}}" data-title="Informe o local">{{$provapublica->nota}}</a> <span style="margin-left:10px"><B>Valores</B></span></td>                
        <td style="background:#edeff1">1º Vogal</td>                
        <td><B>{{$provapublica->vogal_1}}</B></td>      
        <td style="background:#edeff1">Acta</td>                
        <td><a href="#"><i class="fas fa-file-pdf"></i> ACTA FINAL DA DEFESA</a></td>      
    </tr>                                         
    <tr>
        <td style="background:#edeff1">Local da defesa</td>                
        <td><B>{{$provapublica->local}}</B></td>  
        <td style="background:#edeff1">2º Vogal</td>                
        <td><B>{{$provapublica->vogal_2}}</B></td>  
        <td style="background:#edeff1">Acta</td>                
        <td><a href="#"><i class="fas fa-file-pdf"></i> ACTA DA LEITURA DE NOTA</a></td>                              
    </tr>                                
<script>
    $(document).ready(function (){
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>',
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':'{{csrf_token()}}'
            }
        });

        $(".dataprovapublica_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório"
            },
            url:'{{url("editarProvaPublica")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar',
                        timer:1500
                    })
                }
            }
        });

        $(".nota_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(e>20 || e<0)
                    return "A nota deve estar entre 0 à 20 valores";
            },
            url:'{{url("editarProvaPublica")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500                        
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar',
                        timer:1500
                    })
                }
            }
        }); 
    });
</script>                                                                               