<a href="{{ route('vacantes.index') }}" class="text-white text-sm font-bold p-3 {{ Request::is('vacantes') ? 'bg-teal-500' : '' }}">Ver Vacante</a>
<a href="{{ route('vacantes.create') }}" class="text-white text-sm font-bold p-3 {{ Request::is('vacantes/create') ? 'bg-teal-500' : '' }}">Nueva Vacante</a>