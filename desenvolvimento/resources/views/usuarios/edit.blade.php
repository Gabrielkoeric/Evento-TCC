<x-layout title="Editar Usuario '{{$usuario->nome_completo}}' ">
    <x-formulario.forms :action="route('$usuario.update', $usuario)" :nome="$usuario->nome_completo"></x-formulario.forms>
</x-layout>

