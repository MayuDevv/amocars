function Footer() {
    return (
        <footer id="contatti" className="mt-10 bg-gray-900 py-8 text-white">
            <div className="mx-auto max-w-7xl px-6 text-center">
                <h2 className="text-xl font-bold">AmaCars</h2>

                <p id="servizi" className="mt-2 text-gray-400">
                    Vendita auto usate e selezionate
                </p>

                <p id="noleggio" className="mt-4 text-sm text-gray-500">
                    © {new Date().getFullYear()} AmaCars. Tutti i diritti riservati.
                </p>
            </div>
        </footer>
    );
}

export default Footer;