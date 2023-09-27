<x-layout title="Retirada">
    <a href="{{ route('home.index') }}" class="btn btn-dark my-3 pr">Home</a>
    <div>
        <img src="{{ asset('storage/' . $qrcode) }}" alt="imagem" class="img-fluid">
    </div>

</x-layout>
