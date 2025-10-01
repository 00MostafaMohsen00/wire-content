<div>
    <x-mary-carousel :slides="array_map(function ($item) {
        return [
            'image' => asset('storage/' . $item['image'] ?? ''),
        ];
    }, $images)" />
</div>
