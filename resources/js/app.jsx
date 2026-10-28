import React from 'react';
import { createRoot } from 'react-dom/client';
import Home from './Pages/Home';
import '../css/app.css';

const initialData = JSON.parse(
    document.getElementById('app-data')?.textContent || '{}'
);

function App() {
    return <Home data={initialData} />;
}

createRoot(document.getElementById('root')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);