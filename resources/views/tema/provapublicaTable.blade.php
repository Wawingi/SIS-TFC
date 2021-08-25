@foreach($provapublica as $pp)
    <tr>
        <td colspan="3"><span style="text-align:center;font-weight:bold"><i class="fas fa-tasks mr-1"></i>DADOS DA PROVA PÚBLICA</span><a href="#" id_prova="{{$pp->id}}" class="eliminarProvaPublica float-right btn btn-danger btn-sm btn-rounded"><i class='fa fa-trash-alt mr-2'></i>Eliminar</a></td>
    </tr>
    <tr>
        <td colspan="3"><hr style="margin-top:-20px"></td>
    </tr>
    <tr>                
        <td style="background:#edeff1">Data da defesa</td>                
        <td><a href="#" class="dataprovapublica_edit" data-name="created_at" data-type="combodate" data-value="{{$pp->data_defesa}}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="DD/MM/YYYY" data-pk="{{$pp->id}}"></a></td>                
        <td style="background:#edeff1;text-align:center;font-weight:bold"><i class="fas fa-file-signature"></i> ACTAS DA DEFESA</td>
    </tr>                
    <tr>                
        <td style="background:#edeff1">Nota do trabalho</td>                
        <td><a href="#" class="nota_edit" data-name="nota" data-type="number" data-min="0" data-max="20" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o local">{{$pp->nota}}</a> <span style="margin-left:10px"><B>Valor</B></span></td>                
        <td style="text-align:left"><a href='{{ url("abrirActaNota/".base64_encode($pp->id)) }}'><i class="fas fa-file-pdf"></i> ACTA DA LEITURA DE NOTA</a></td>
    </tr>                      
    <tr>                
        <td style="background:#edeff1">Local da defesa</td>                
        <td><B>{{$pp->local}}</B></td>
        <td style="text-align:left"><a href="#"><i class="fas fa-file-pdf"></i> ACTA FINAL DA DEFESA</a></td>                
    </tr>                      
    <tr>                
        <td style="background:#edeff1">Presidente</td>                
        <td><B>{{$pp->presidente}}</B></td>                
    </tr>                
    <tr>                
        <td style="background:#edeff1">Secretário</td>                
        <td><B>{{$pp->secretario}}</B></td>                
    </tr>                
    <tr>                
        <td style="background:#edeff1">1º Vogal</td>                
        <td><B>{{$pp->vogal_1}}</B></td>                
    </tr>  
    <tr>                
        <td style="background:#edeff1">2º Vogal</td>                
        <td><B>{{$pp->vogal_2}}</B></td>                
    </tr>  
@endforeach
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