@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Doctor Detail: {{ $doctor->name }}</h1>
        <a href="{{ route('doctors.edit', $doctor) }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Doctor</a>
    </div>

    <div class="mb-4">
        <strong>Name:</strong> {{ $doctor->name }}
    </div>
    <div class="mb-4">

        <strong>Specialty:</strong>
        @foreach ($doctor->specialty as $key => $specialty)
            {{ $specialty->name }}
            @if (!$loop->last)
                ,
            @endif
        @endforeach

    </div>

    <div class="mb-4">
        <strong>Clinic Name - Clinic Address:</strong>
        @if ($doctor->clinics->isNotEmpty() && count($doctor->clinics) > 0)
            @php $isGrey = false; @endphp
                @foreach ($doctor->clinics as $clinic)
                    <div style="background-color: {{ $isGrey ? '#f2f2f2' : 'white' }}; padding: 5px;">
                        {{ $clinic->name }} - {{ $clinic->address }}
                    </div>
                    @php $isGrey = !$isGrey; @endphp
                @endforeach
        @endif
    </div>

    <h2 class="text-xl font-bold mb-4">Related Tests</h2>
    <table class="bg-white w-full border-collapse">
        <thead>
            <tr class="bg-gray-300">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Updated</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Test Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctor->tests as $test)
                <tr>
                    <td class="border px-4 py-2">{{ $test->id }}</td>
                    <td class="border px-4 py-2">{{ $test->updated_at->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">{{ $test->description }}</td>
                    <td class="border px-4 py-2">{{ $test->testName->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
