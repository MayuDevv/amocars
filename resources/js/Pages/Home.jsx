import Navbar from '../components/Navbar';
import FeaturedSlider from '../components/FeaturedSlider';
import CarCard from '../components/CarCard';
import Footer from '../components/Footer';

function Home({ data }) {
    return (
        <>
            <Navbar />

            <main>
                <FeaturedSlider cars={data.featuredCars || []} />

                <section id="auto" className="py-16">
                    <div className="mx-auto max-w-7xl px-6">
                        <h2 className="mb-10 text-4xl font-bold">
                            Le nostre auto
                        </h2>

                        {data.cars?.length ? (
                            <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                                {data.cars.map((car) => (
                                    <CarCard key={car.id} car={car} />
                                ))}
                            </div>
                        ) : (
                            <p className="rounded-xl bg-white p-8 text-gray-600">
                                Al momento non ci sono auto pubblicate.
                            </p>
                        )}

                        {data.pagination?.lastPage > 1 && (
                            <div className="mt-10 flex items-center justify-between">
                                <a
                                    className={`rounded-lg px-4 py-2 ${
                                        data.pagination.previousPageUrl
                                            ? 'bg-white shadow'
                                            : 'pointer-events-none text-gray-400'
                                    }`}
                                    href={data.pagination.previousPageUrl || '#'}
                                >
                                    ← Precedenti
                                </a>

                                <span>
                                    Pagina {data.pagination.currentPage} di{' '}
                                    {data.pagination.lastPage}
                                </span>

                                <a
                                    className={`rounded-lg px-4 py-2 ${
                                        data.pagination.nextPageUrl
                                            ? 'bg-white shadow'
                                            : 'pointer-events-none text-gray-400'
                                    }`}
                                    href={data.pagination.nextPageUrl || '#'}
                                >
                                    Successive →
                                </a>
                            </div>
                        )}
                    </div>
                </section>
            </main>

            <Footer />
        </>
    );
}

export default Home;