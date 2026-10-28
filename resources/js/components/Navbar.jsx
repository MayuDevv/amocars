function Navbar() {
    return (
        <nav className="sticky top-0 z-50 bg-white shadow">
            <div className="mx-auto max-w-7xl px-6">
                <div className="flex h-20 items-center justify-between">
                    <a href="/" className="text-3xl font-black tracking-wider">
                        AMACARS
                    </a>

                    <div className="hidden gap-8 md:flex">
                        <a href="/">Home</a>
                        <a href="#auto">Auto</a>
                        <a href="#servizi">Servizi</a>
                        <a href="#noleggio">Noleggio</a>
                        <a href="#contatti">Contatti</a>
                    </div>
                </div>
            </div>
        </nav>
    );
}

export default Navbar;