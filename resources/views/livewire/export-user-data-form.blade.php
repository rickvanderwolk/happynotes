<x-action-section>
    <x-slot name="title">
        {{ __('Export Data') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Download all your notes in CSV or JSON format.') }}
    </x-slot>

    <x-slot name="content">
        <div class="">
            <a
                href="{{ route('user.export.notes.create', ['format' => 'csv']) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Download CSV
            </a>
            <a
                href="{{ route('user.export.notes.create', ['format' => 'json']) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Download JSON
            </a>
        </div>
    </x-slot>
</x-action-section>
