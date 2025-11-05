@php
$menuItems = [
['label' => 'Dashboard', 'route' => 'admin.dashboard', 'children' => []],
['label' => 'Cars', 'route' => '', 'children' => [
['label' => 'Cars Inventory', 'route' => 'admin.cars.index'],
['label' => 'Repairs', 'route' => 'admin.repairs.index'],
['label' => 'Rentals', 'route' => 'admin.rentals.index'],
['label' => 'Sales', 'route' => 'admin.sales.index'],
]],
['label' => 'Customers', 'route' => 'admin.customers.index', 'children' => []],
['label' => 'Reports', 'route' => 'admin.reports.index', 'children' => []],
['label' => 'Settings', 'route' => 'admin.settings', 'children' => []],
];
@endphp

<div class="w-64 bg-blue-900 text-gray-100 flex-shrink-0 h-screen flex flex-col">
    <div class="px-6 py-4">
        <h2 class="text-2xl font-bold text-white">CarGarage Admin</h2>
    </div>

    <nav class="mt-6 flex-1 overflow-y-auto">
        @foreach($menuItems as $item)
        @if(empty($item['children']))
        <a href="{{ $item['route'] !== '#' ? route($item['route']) : '#' }}"
            class="block px-6 py-3 hover:bg-blue-800 rounded transition-colors
                          {{ request()->routeIs(str_replace('.index','.*',$item['route'])) ? 'bg-blue-700 text-white' : '' }}">
            {{ $item['label'] }}
        </a>
        @else
        <div x-data="{ open: false }">
            <a href="#"
                @click.prevent="open = !open"
                class="block px-6 py-3 hover:bg-blue-800 rounded flex justify-between items-center transition-colors
                              {{ collect($item['children'])->pluck('route')->contains(request()->route()->getName()) ? 'bg-blue-700 text-white' : '' }}">
                <span>{{ $item['label'] }}</span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <div x-show="open" class="mt-1 space-y-1 pl-6">
                @foreach($item['children'] as $child)
                <a href="{{ route($child['route']) }}"
                    class="block px-6 py-2 text-gray-200 hover:bg-blue-800 rounded transition-colors
                                      {{ request()->routeIs(str_replace('.index','.*',$child['route'])) ? 'bg-blue-700 text-white' : '' }}">
                    {{ $child['label'] }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </nav>
</div>