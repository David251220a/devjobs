<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li
                class="border border-gray-500 px-10 py-3 rounded mr-4 mt-2"
                :class="verificarClaseActiva(skills)"
                v-for="(skills, i) in this.skills" 
                v-bind:key="i"
                @click="activar($event)"
            >{{skills}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>

</template>

<script>
    export default {
        props: ['skills', 'oldskills'],
        mounted(){

        },
        data: function(){
            return {
                habilidades: new Set()
            }
        },
        created: function(){
            if (this.oldskills){
                const skillsarray = this.oldskills.split(','); 
                skillsarray.forEach(skill => this.habilidades.add(skill));
            }
        },
        mounted: function(){
            document.querySelector('#skills').value = this.oldskills;
        },
        methods: {
            activar(e){
                if(e.target.classList.contains('bg-teal-400')){
                    //Si ya esta activo
                    e.target.classList.remove('bg-teal-400');
                    //eliminar de habilidads
                    this.habilidades.delete(e.target.textContent);
                }else{
                    //Para activar
                    e.target.classList.add('bg-teal-400');
                    //agregar habiliadades
                    this.habilidades.add(e.target.textContent);
                }

                //agregar habilidades al input oculto
                const stringhabilidades = [...this.habilidades];
                document.querySelector('#skills').value = stringhabilidades;
            },
            verificarClaseActiva(skills){
                return this.habilidades.has(skills) ? 'bg-teal-400' : '';
            }
        }
    }
</script>

