@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        @if ($potentialDuplicates->isNotEmpty() && count($potentialDuplicates) > 0)
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Duplicate clinics</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="bg-white w-full border-collapse">
                                <thead>
                                <tr>
                                    <th class="border px-4 py-2">Name</th>
                                    <th class="border px-4 py-2">House</th>
                                    <th class="border px-4 py-2">Duplicates Count</th>
                                    <th class="border px-4 py-2">Duplicate IDs</th>
                                    <th class="border px-4 py-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($potentialDuplicates as $duplicate)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $duplicate->name }}</td>
                                        <td class="border px-4 py-2">{{ $duplicate->house }}</td>
                                        <td class="border px-4 py-2">{{ $duplicate->duplicates_count }}</td>
                                        <td class="border px-4 py-2">{{ $duplicate->duplicate_ids }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('clinics.clinics_merge') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="duplicate_ids" value="{{ $duplicate->duplicate_ids }}">
                                                <button type="submit" class="btn btn-primary">Merge</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">No duplicate clinics found!!</h1>
            </div>
        @endif
    </div>

@endsection
