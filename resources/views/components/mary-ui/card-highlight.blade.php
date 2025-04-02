@props(['highlight'])
<div class="p-10 py-10 mb-5 rounded-lg shadow-lg bg-base-50 dark:bg-gray-800">
    <div>
        <p class="text-gray-900  dark:text-gray-100">
            {{ $highlight->text }}
        </p>
    </div>

    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        <strong>Location:</strong> {{ $highlight->location }}
        <br>
        <strong>Chapter:</strong> {{ $highlight->chapter }}
        <div class="flex items-center mt-3 ">
            <x-heroicon-o-heart class="w-6 h-6 text-gray-500 align-middle hover:text-gray-50" />

            <span>Save</span>
        </div>

    </div>
</div>
