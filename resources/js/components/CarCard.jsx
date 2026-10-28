import CarImage from './CarImage';

const money = (value) =>
    new Intl.NumberFormat('it-IT', {
        maximumFractionDigits: 0
    }).format(Number(value || 0));

const kmFormat = (value) =>
    new Intl.NumberFormat('it-IT').format(Number(value || 0));

function CarCard({ car }) {
    const message = encodeURIComponent(
        `Salve, sono interessato alla ${car.brand} ${car.model}`
    );

    return (
        <article className="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:shadow-xl">
            <div className="relative h-64">
                <CarImage
                    car={car}
                    className="h-full w-full object-cover"
                />

                {car.year && (
                    <span className="absolute right-3 top-3 rounded-full bg-black px-3 py-1 text-sm text-white">
                        {car.year}
                    </span>
                )}
            </div>

            <div className="p-5">
                <h3 className="text-xl font-bold text-gray-900">
                    {car.brand} {car.model}
                </h3>

                <div className="mt-3 space-y-1 text-gray-600">
                    <p>
                        🚗 {car.km == null ? 'Chilometraggio n/d' : `${kmFormat(car.km)} km`}
                    </p>

                    <p>⚙️ {car.fuel || 'Carburante n/d'}</p>

                    <p className="text-lg font-bold text-gray-900">
                        💶 {money(car.price)} €
                    </p>
                </div>

                <a
                    href={`https://wa.me/?text=${message}`}
                    target="_blank"
                    rel="noreferrer"
                    className="mt-5 block rounded-xl bg-green-500 py-3 text-center text-white transition hover:bg-green-600"
                >
                    Contatta su WhatsApp
                </a>
            </div>
        </article>
    );
}

export default CarCard;