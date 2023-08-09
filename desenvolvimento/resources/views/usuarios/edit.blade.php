<x-layout title="Editar Usuario '{{$usuario->nome_completo}}'">
    <x-formulario.forms :action="route('usuario.update', ['usuario' => $usuario->id])"
                        :nome="$usuario->nome_completo"
                        :email="$usuario->email"
                        :celular="$usuario->celular"
                        :permissao="$usuario->permissao"
    >
    </x-formulario.forms>
</x-layout>

