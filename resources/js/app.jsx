import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';

const initialData = JSON.parse(document.getElementById('app-data')?.textContent || '{}');
const money = (value) => new Intl.NumberFormat('it-IT', { maximumFractionDigits: 0 }).format(Number(value || 0));
const kmFormat = (value) => new Intl.NumberFormat('it-IT').format(Number(value || 0));

function Navbar() {
    return <nav className="sticky top-0 z-50 bg-white shadow">
        <div className="mx-auto max-w-7xl px-6"><div className="flex h-20 items-center justify-between">
            <a href="/" className="text-3xl font-black tracking-wider">AMACARS</a>
            <div className="hidden gap-8 md:flex"><a href="/">Home</a><a href="#auto">Auto</a><a href="#servizi">Servizi</a><a href="#noleggio">Noleggio</a><a href="#contatti">Contatti</a></div>
        </div></div>
    </nav>;
}

function CarImage({ car, className = '' }) {
    const [broken, setBroken] = useState(false);
    const src = car.images?.[0];
    if (!src || broken) return <div className={`flex items-center justify-center bg-gray-200 text-gray-500 ${className}`}><span>Foto non disponibile</span></div>;
    return <img src={src} alt={`${car.brand} ${car.model}`} className={className} loading="lazy" onError={() => setBroken(true)} />;
}

function CarCard({ car }) {
    const message = encodeURIComponent(`Salve, sono interessato alla ${car.brand} ${car.model}`);
    return <article className="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:shadow-xl">
        <div className="relative h-64"><CarImage car={car} className="h-full w-full object-cover" />
            {car.year && <span className="absolute right-3 top-3 rounded-full bg-black px-3 py-1 text-sm text-white">{car.year}</span>}
        </div>
        <div className="p-5"><h3 className="text-xl font-bold text-gray-900">{car.brand} {car.model}</h3>
            <div className="mt-3 space-y-1 text-gray-600"><p>🚗 {car.km == null ? 'Chilometraggio n/d' : `${kmFormat(car.km)} km`}</p><p>⚙️ {car.fuel || 'Carburante n/d'}</p><p className="text-lg font-bold text-gray-900">💶 {money(car.price)} €</p></div>
            <a href={`https://wa.me/?text=${message}`} target="_blank" rel="noreferrer" className="mt-5 block rounded-xl bg-green-500 py-3 text-center text-white transition hover:bg-green-600">Contatta su WhatsApp</a>
        </div>
    </article>;
}

function FeaturedSlider({ cars }) {
    const [active, setActive] = useState(0);
    useEffect(() => {
        if (cars.length < 2) return undefined;
        const timer = window.setInterval(() => setActive((index) => (index + 1) % cars.length), 5000);
        return () => window.clearInterval(timer);
    }, [cars.length]);
    if (!cars.length) return null;
    const car = cars[active];
    return <section className="relative h-[440px] overflow-hidden bg-gray-800 md:h-[650px]">
        <CarImage car={car} className="absolute inset-0 h-full w-full object-cover" />
        <div className="absolute inset-0 bg-black/50" />
        <div className="relative z-10 mx-auto flex h-full max-w-7xl items-end px-8 pb-16 md:px-20 md:pb-20"><div className="max-w-xl text-white">
            <p className="mb-3 font-semibold uppercase tracking-[0.25em] text-white/80">Selezione AMACARS</p>
            <h1 className="text-4xl font-bold leading-tight md:text-5xl">{car.brand} {car.model}</h1>
            <p className="mt-3 text-lg text-gray-200">{[car.year, car.fuel, car.km != null ? `${kmFormat(car.km)} km` : null].filter(Boolean).join(' • ')}</p>
            <div className="mt-4 text-3xl font-bold">€ {money(car.price)}</div>
            <a href={`https://wa.me/?text=${encodeURIComponent(`Salve, vorrei informazioni sulla ${car.brand} ${car.model}`)}`} target="_blank" rel="noreferrer" className="mt-6 inline-block rounded-xl bg-green-500 px-8 py-3 text-lg text-white hover:bg-green-600">Richiedi informazioni</a>
            {cars.length > 1 && <div className="mt-6 flex gap-2">{cars.map((item, i) => <button key={item.id} aria-label={`Mostra ${item.brand} ${item.model}`} onClick={() => setActive(i)} className={`h-2.5 w-8 rounded-full ${i === active ? 'bg-white' : 'bg-white/40'}`} />)}</div>}
        </div></div>
    </section>;
}

function Footer() {
    return <footer id="contatti" className="mt-10 bg-gray-900 py-8 text-white"><div className="mx-auto max-w-7xl px-6 text-center"><h2 className="text-xl font-bold">AmaCars</h2><p id="servizi" className="mt-2 text-gray-400">Vendita auto usate e selezionate</p><p id="noleggio" className="mt-4 text-sm text-gray-500">© {new Date().getFullYear()} AmaCars. Tutti i diritti riservati.</p></div></footer>;
}

function App() {
    const [data] = useState(initialData);
    return <><Navbar /><main><FeaturedSlider cars={data.featuredCars || []} /><section id="auto" className="py-16"><div className="mx-auto max-w-7xl px-6"><h2 className="mb-10 text-4xl font-bold">Le nostre auto</h2>
        {data.cars?.length ? <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">{data.cars.map((car) => <CarCard key={car.id} car={car} />)}</div> : <p className="rounded-xl bg-white p-8 text-gray-600">Al momento non ci sono auto pubblicate.</p>}
        {data.pagination?.lastPage > 1 && <div className="mt-10 flex items-center justify-between"><a className={`rounded-lg px-4 py-2 ${data.pagination.previousPageUrl ? 'bg-white shadow' : 'pointer-events-none text-gray-400'}`} href={data.pagination.previousPageUrl || '#'}>← Precedenti</a><span>Pagina {data.pagination.currentPage} di {data.pagination.lastPage}</span><a className={`rounded-lg px-4 py-2 ${data.pagination.nextPageUrl ? 'bg-white shadow' : 'pointer-events-none text-gray-400'}`} href={data.pagination.nextPageUrl || '#'}>Successive →</a></div>}
    </div></section></main><Footer /></>;
}

createRoot(document.getElementById('root')).render(<React.StrictMode><App /></React.StrictMode>);
