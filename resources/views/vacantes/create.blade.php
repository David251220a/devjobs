@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css"
    integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.css"
    integrity="sha512-qkeymXyips4Xo5rbFhX+IDuWMDEmSn7Qo7KpPMmZ1BmuIA95IPVYsVZNn8n4NH/N30EY7PUZS3gTeTPoAGo1mA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('navegacion')

    @include('ui.administradornav')

@endsection


@section('content')

    <h1 class="text-2xl text-center mt-10">Nueva Vacante</h1>

    <form class="max-w-lg mx-auto my-10" action="{{ route('vacantes.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Titulo Vacante:</label>
            <input id="titulo" type="titulo" class="p-3 bg-gray-100 rounded form-input w-full
            @error('titulo') border-red-500 border @enderror" name="titulo" value="{{ old('titulo') }}" autofocus>
            @error('titulo')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Categoria</label>
            <select name="categoria" id="categoria"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500
            p-3 bg-gray-100">

                <option disabled selected value="">--Selecciona--</option>
                @foreach ($categorias as $categoria)
                    <option
                    {{ old('categoria') == $categoria->id ? 'selected' : ''}}
                    value="{{ $categoria->id }}">{{ $categoria->nombre}}</option>
                @endforeach

            </select>
            @error('categoria')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Experiencia</label>
            <select name="experiencia" id="experiencia"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500
            p-3 bg-gray-100">

                <option disabled selected value="">--Selecciona--</option>
                @foreach ($experiencias as $experiencia)
                    <option
                    {{ old('experiencia') == $experiencia->id ? 'selected' : ''}}
                    value="{{ $experiencia->id }}">{{ $experiencia->nombre}}</option>
                @endforeach

            </select>

            @error('experiencia')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Ubicacion</label>
            <select name="ubicacion" id="ubicacion"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500
            p-3 bg-gray-100">

                <option disabled selected value="">--Selecciona--</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option
                    {{ old('ubicacion') == $ubicacion->id ? 'selected' : ''}}
                    value="{{ $ubicacion->id }}">{{ $ubicacion->nombre}}</option>
                @endforeach

            </select>
            @error('ubicacion')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Salario</label>
            <select name="salario" id="salario"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500
            p-3 bg-gray-100">

                <option disabled selected value="">--Selecciona--</option>
                @foreach ($salarios as $salario)
                    <option
                    {{ old('salario') == $salario->id ? 'selected' : ''}}
                    value="{{ $salario->id }}">{{ $salario->nombre}}</option>
                @endforeach

            </select>
            @error('salario')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Descripcion del Puesto</label>
            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>
            <input type="hidden" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">
            @error('descripcion')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror

        </div>

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-2">Imagen del Puesto</label>
            <div id="dropzoneDevJobs" class="dropzone rounded bg-gray-100"></div>
            <input type="hidden" name="imagen" id="imagen" value="{{ old('imagen') }}">
            <p id="error"></p>
            @error('imagen')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        @php
            $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails']
        @endphp

        <div class="mb-5">

            <label class="block text-gray-700 text-sm mb-5">Habilidades y conocimientos: <span class="text-xs">(Elige al menos 3)</span></label>
            <lista-skills
            :skills="{{ json_encode($skills) }}"
            :oldskills="{{json_encode( old('skills')) }}">
            </lista-skills>
            @error('skills')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
                    <strong  class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <button
        type="submit"
        class="bg-teal-500 w-full hover:bg-teal-700 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase font-bold">
            Publicar Vacante
        </button>


    </form>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js"
    integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js"
    integrity="sha512-FFyHlfr2vLvm0wwfHTNluDFFhHaorucvwbpr0sZYmxciUj3NoW1lYpveAQcx2B+MnbXbSrRasqp43ldP9BKJcg==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>

    <script>

        Dropzone.autoDiscover = false;

        document.addEventListener('DOMContentLoaded', () => {
            //MEDIUN EDITOR
            const editor = new MediumEditor('.editable', {
                toolbar :{
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight'
                        , 'justifyFull', 'orderedlist', 'unorderedlist', 'h2', 'h3'],
                    static: true,
                    sticky: true
                },
                placeholder:{
                    text: 'Información de la vacante'
                }
            });

            editor.subscribe('editableInput', function(eventObj, editable){
                const contenido  = editor.getContent();
                document.querySelector('#descripcion').value = contenido;
            })
            //agregar al mediun editaor si falla la validacion
            editor.setContent(document.querySelector('#descripcion').value);

            //DROPZONE
            const dropzone = new Dropzone('#dropzoneDevJobs', {
                url: "/vacantes/imagen",
                dictDefaultMessage: 'Sube aqui tu archivo',
                acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
                addRemoveLinks: true,
                dictRemoveFile: 'Borrar Archivo',
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                init: function(){
                    if(document.querySelector('#imagen').value.trim()){
                        let imagenpublicada = {};
                        imagenpublicada.size = 1234;
                        imagenpublicada.name = document.querySelector('#imagen').value;
                        this.options.addedfile.call(this, imagenpublicada);
                        this.options.thumbnail.call(this, imagenpublicada, `/storage/vacantes/${imagenpublicada.name}`) ;
                        imagenpublicada.previewElement.classList.add('dz-sucess');
                        imagenpublicada.previewElement.classList.add('dz-complete');
                    }
                },
                success: function(file, response){
                    console.log(response.correcto);
                    document.querySelector('#error').textContent = '';
                    //coloca respuesta del servidor en el input
                    document.querySelector('#imagen').value = response.correcto;
                    //añadir al objeto el nombre del servirdor
                    file.nombreservidor = response.correcto;
                },
                maxfilesexceeded: function(file){
                    if( this.files[1] != null){
                        this.removeFile(this.files[0]);
                        this.addFile(file);
                    }
                },
                removedfile: function(file){
                    file.previewElement.parentNode.removeChild(file.previewElement);
                    params = {
                        imagen: file.nombreservidor ?? document.querySelector('#imagen').value
                    }
                    axios.post('/vacantes/borrarimagen', params)
                        .then(respuesta => console.log(respuesta))
                }

            });


        })
    </script>

@endsection
