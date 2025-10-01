<div>
    @if ($this->articles->count() > 0)

        <div class="grid sm:grid-cols-2 gap-6 lg:grid-cols-3">
            @foreach ($this->articles as $article)
                <livewire:components.article-card :article="$article" :key="$article->id" />
            @endforeach
        </div>
        @if ($this->show_load_more)
            <div>
                <div class="text-center mt-8">
                    <button wire:click="loadMore" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-blue-600 text-white font-bold rounded">
                        Load More
                    </button>
                </div>
            </div>
        @endif
    @endif
</div>
