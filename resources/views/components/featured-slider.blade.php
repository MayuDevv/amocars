<section class="w-full overflow-hidden">

@if($featuredCars->count())

<div id="featuredSlider" class="relative">

    @foreach($featuredCars as $index => $car)

    <div class="featured-slide {{ $index == 0 ? '' : 'hidden' }} relative h-[650px]">

        @if(!empty($car->images))

            <img
                src="{{ asset('storage/'.$car->images[0]) }}"
                class="absolute inset-0 w-full h-full object-cover">

        @endif


        {{-- oscuramento immagine --}}
        <div class="absolute inset-0 bg-black/40"></div>


        <div class="relative z-10 h-full flex items-end pb-20 px-8 md:px-20">

            <div class="text-white max-w-xl">

                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    {{ $car->brand }} {{ $car->model }}
                </h2>


                <p class="text-lg md:text-xl mt-3 text-gray-200">
                    {{ $car->year }} • {{ $car->fuel }} • {{ number_format($car->mileage,0,',','.') }} km
                </p>


                <div class="text-3xl font-bold mt-4">
                    € {{ number_format($car->price,0,',','.') }}
                </div>


                <a 
                href="https://wa.me/TUONUMERO"
                class="inline-block mt-6 bg-green-500 hover:bg-green-600 px-8 py-3 rounded-xl text-lg">
                    Richiedi informazioni
                </a>

            </div>

        </div>

    </div>

    @endforeach

</div>


<script>

let slides = document.querySelectorAll('.featured-slide');
let current = 0;

setInterval(()=>{

    slides[current].classList.add('hidden');

    current++;

    if(current >= slides.length){
        current = 0;
    }

    slides[current].classList.remove('hidden');

},5000);

</script>


@endif

</section>