@foreach ($categorias as $item)

    <a href="{{ route('categoria.show', $item) }}" class="text-white text-sm uppercase font-bold p-3">
        {{$item->nombre}}
    </a>


@endforeach
