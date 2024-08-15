<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>Type User : {{ $user->type }}</div>
                    <ul class="space-y-4">
                        @foreach ($articles as $article)
                            <li class="border-b-4 pb-4">
                                <h2 class="text-xl font-semibold text-blue-600">{{ $article->title }}</h2>
                                <div id="content-{{ $article->id }}" class="mt-2 overflow-hidden h-16 transition-all duration-300 ease-in-out">
                                    <p class="text-gray-700">
                                        {!! nl2br($article->text) !!}
                                    </p>
                                    <video controls style="height: 500ox; width: auto;">
                                        <source src="{{ asset($article->video->title) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <a href="#" onclick="toggleContent(event, '{{ $article->id }}')" class="text-blue-500 hover:underline mt-2 block">
                                    <span id="toggle-text-{{ $article->id }}">Baca Selengkapnya</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @push('custom_script')
    <script>

        function toggleContent(event, id) {

            event.preventDefault();
            const content = document.getElementById(`content-${id}`);
            const toggleText = document.getElementById(`toggle-text-${id}`);

            if (content.classList.contains('h-16') && !content.classList.contains('h-auto')) {
                content.classList.remove('h-16');
                content.classList.add('h-auto');
                toggleText.textContent = 'Tutup';
            } else if (!content.classList.contains('h-16') && content.classList.contains('h-auto')) {
                content.classList.add('h-16');
                content.classList.remove('h-auto');
                toggleText.textContent = 'Baca Selengkapnya';
            }
        }
    </script>
    @endpush
</x-app-layout>

