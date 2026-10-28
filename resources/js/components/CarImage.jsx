import { useState } from 'react';

function CarImage({ car, className = '' }) {
    const [broken, setBroken] = useState(false);
    const src = car.images?.[0];

    if (!src || broken) {
        return (
            <div className={`flex items-center justify-center bg-gray-200 text-gray-500 ${className}`}>
                <span>Foto non disponibile</span>
            </div>
        );
    }

    return (
        <img
            src={src}
            alt={`${car.brand} ${car.model}`}
            className={className}
            loading="lazy"
            onError={() => setBroken(true)}
        />
    );
}

export default CarImage;