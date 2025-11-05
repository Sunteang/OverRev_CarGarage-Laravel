@extends('layouts.admin')

@section('title', 'Repair Details')

@section('content')
<div class="container mx-auto p-6 space-y-8">

    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold">{{ $repair->car->make }} {{ $repair->car->model }}</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.repairs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-full font-semibold transition">Back</a>
            <a href="{{ route('admin.repairs.edit', $repair) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold transition">Edit Repair</a>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-10">

        <div class="space-y-4">
            <p><span class="font-semibold">Car:</span> {{ $repair->car->make }} {{ $repair->car->model }} ({{ $repair->car->year }})</p>
            <p><span class="font-semibold">Repair Date:</span> {{ \Carbon\Carbon::parse($repair->repair_date)->format('Y-m-d') }}</p>
            <p><span class="font-semibold">Cost:</span> ${{ number_format($repair->cost, 2) }}</p>
            <p><span class="font-semibold">Status:</span> <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">{{ ucfirst(str_replace('_',' ',$repair->status)) }}</span></p>
        </div>

        <div class="space-y-4">
            <p><span class="font-semibold">Description:</span></p>
            <p class="bg-gray-50 p-4 rounded-xl border">{{ $repair->description ?? 'No description provided.' }}</p>
        </div>
    </div>
</div>
@endsection