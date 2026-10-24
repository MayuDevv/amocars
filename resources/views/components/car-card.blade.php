@props(['car'])

<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

    {{-- Immagine auto --}}
    <div class="relative h-64">

        @if(!empty($car->images))

            <img
                src="{{ asset('storage/'.$car->images[0]) }}"
                alt="{{ $car->brand }} {{ $car->model }}"
                class="w-full h-full object-cover">

        @endif

        <span class="absolute top-3 right-3 bg-black text-white px-3 py-1 rounded-full text-sm">
            {{ $car->year }}
        </span>

    </div>


    {{-- Contenuto --}}
    <div class="p-5">

        <h3 class="text-xl font-bold text-gray-900">
            {{ $car->brand }} {{ $car->model }}
        </h3>

        <div class="mt-3 space-y-1 text-gray-600">

            <p>
                🚗 {{ $car->km }} km
            </p>

            <p>
                ⚙️ {{ $car->fuel }}
            </p>

            <p>
                💶 {{ number_format($car->price, 0, ',', '.') }} €
            </p>

        </div>


        {{-- Bottone WhatsApp --}}
        <a 
            href="https://wa.me/NUMERO?text=Salve,%20sono%20interessato%20alla%20{{ urlencode($car->brand.' '.$car->model) }}"
            target="_blank"
            class="mt-5 block text-center bg-green-500 text-white py-3 rounded-xl hover:bg-green-600 transition"
        >
            Contatta su WhatsApp
        </a>

    </div>

</div>