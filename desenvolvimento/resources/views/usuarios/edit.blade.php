<x-layout title="Editar Usuario '{{$request->nome}}' ">
    <x-formulario.forms :action="route('$usuario.update', $usuario)" :nome="$usuario->nome_completo"></x-formulario.forms>
</x-layout>

