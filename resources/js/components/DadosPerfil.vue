<template>
    <h4>VUE JS + LARAVEL</h4>  
</template>

<script>
	export default{
		data(){
			return {
				utilizadores:[],
				utilizador:{
					id:'',
					nome:'',
					telefone:'',
					bi:''					
				},
			};
		},
		created(){
			this.listarNoticias();
		},
		methods:{
			listarNoticias(){
				alert('IM HERE');
				axios.get('listarUsers')
				.then(response => {
					console.log('VALOR: '+response.data);
					this.utilizadores = response.data
				})
				.catch(e => {
					this.errors.push(e);
					alert('ERROR');
				})
			}
		}
	};
</script>
