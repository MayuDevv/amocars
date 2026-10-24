@extends('layouts.app')

@section('content')

@include('components.featured-slider')

<section class="py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold mb-10">

            Le nostre auto

        </h2>

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">

            @foreach($cars as $car)

                @include('components.car-card')

            @endforeach

        </div>

    </div>

</section>

@endsection