<x-app-layout>
    <x-slot name="header">👋 Hello, {{ Auth::user()->name }}!
    </x-slot>

{{-- <div> --}}


{{--
<x-mary-stat
    title="Highlights"
    description="This month"
    value="22.124"
    icon="o-arrow-trending-down"
    class="text-orange-500"
    color="text-pink-500"
    tooltip-right="Gosh!" />
</div> --}}

</x-app-layout>
