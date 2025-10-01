<div>
    @foreach ($images as $image)
        <img src="{{ asset('storage/' . $image['image'] ?? '') }}" class="w-32" alt="">
    @endforeach
</div>
