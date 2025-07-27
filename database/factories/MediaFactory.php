<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Media;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {

        $fileName = uniqid('product_') . '.jpg';
        $filePath = 'products/' . $fileName;

        $image = Http::get('https://picsum.photos/400/300');
        Storage::disk('public')->put($filePath, $image->body());

        return [
            'file_name'  => $this->faker->word() . '.jpg',
            'file_path'  => $filePath,
            'file_type'  => 'image/jpeg',
            'file_size'  => $this->faker->numberBetween(50000, 2000000),
            'created_by' => User::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}

