import { useEffect, useState } from 'react';
import CarImage from './CarImage';

const money = (value) =>
    new Intl.NumberFormat('it-IT', {
        maximumFractionDigits: 0
    }).format(Number(value || 0));

const kmFormat = (value) =>
    new Intl.NumberFormat('it-IT').format(Number(value || 0));

function FeaturedSlider({ cars }) {
    const [active, setActive] = useState(0);

    useEffect(() => {
        if (cars.length < 2) return undefined;

        const timer = window.setInterval(
            () => setActive((index) => (index + 1) % cars.length),
            5000
        );

        return () => window.clearInterval(timer);
    }, [cars.length]);

    if (!cars.length) return null;

    const car = cars[active];

    return (
        <section className="relative h-[440px] overflow-hidden bg-gray-800 md:h-[650px]">
            <CarImage
                car={car}
                className="absolute inset-0 h-full w-full object-cover"
            />

            <div className="absolute inset-0 bg-black/50" />

            <div className="relative z-10 mx-auto flex h-full max-w-7xl items-end px-8 pb-16 md:px-20 md:pb-20">
                <div className="max-w-xl text-white">
                    <p className="mb-3 font-semibold uppercase tracking-[0.25em] text-white/80">
                        Selezione AMACARS
                    </p>

                    <h1 className="text-4xl font-bold leading-tight md:text-5xl">
                        {car.brand} {car.model}
                    </h1>

                    <p className="mt-3 text-lg text-gray-200">
                        {[
                            car.year,
                            car.fuel,
                            car.km != null ? `${kmFormat(car.km)} km` : null
                        ].filter(Boolean).join(' • ')}
                    </p>

                    <div className="mt-4 text-3xl font-bold">
                        € {money(car.price)}
                    </div>

                    <a
                        href={`https://wa.me/?text=${encodeURIComponent(`Salve, vorrei informazioni sulla ${car.brand} ${car.model}`)}`}
                        target="_blank"
                        rel="noreferrer"
                        className="mt-6 inline-block rounded-xl bg-green-500 px-8 py-3 text-lg text-white hover:bg-green-600"
                    >
                        Richiedi informazioni
                    </a>

                    {cars.length > 1 && (
                        <div className="mt-6 flex gap-2">
                            {cars.map((item, i) => (
                                <button
                                    key={item.id}
                                    aria-label={`Mostra ${item.brand} ${item.model}`}
                                    onClick={() => setActive(i)}
                                    className={`h-2.5 w-8 rounded-full ${
                                        i === active ? 'bg-white' : 'bg-white/40'
                                    }`}
                                />
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
}

export default FeaturedSlider;