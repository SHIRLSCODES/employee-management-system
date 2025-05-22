<x-layouts.app.sidebar :title="$title ?? null">
     @isset($header)
        <div class="mb-4">
            {{ $header }}
        </div>
    @endisset

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
