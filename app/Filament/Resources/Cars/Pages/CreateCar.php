<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use App\Models\CarImage;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['images']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $images = $this->data['images'] ?? [];

        foreach ($images as $image) {
            CarImage::create([
                'car_id' => $this->record->id,
                'image' => $image,
            ]);
        }
    }
}