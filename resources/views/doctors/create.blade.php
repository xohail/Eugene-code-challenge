@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Add Doctor</h1>

    <form action="{{ route('doctors.store') }}" method="post">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="specialty" class="block mb-2">Specialty</label>
            <select name="specialty[]" id="specialty" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
                <option value="" disabled>Select Specialty</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('test_name_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }} </option>
                @endforeach
            </select>
            @error('specialty')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <h3 class="text-2xl font-bold mb-4">Add Clinic</h3>
        <div class="mb-4">
            <label for="clinic_name" class="block mb-2">Clinic Name</label>
            <input type="text" name="clinic_name" id="clinic_name" value="{{ old('clinic_name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_name')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="clinic_house" class="block mb-2">Clinic House</label>
            <input type="text" name="clinic_house" id="clinic_house" value="{{ old('clinic_house') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_house')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="clinic_street" class="block mb-2">Clinic Street</label>
            <input type="text" name="clinic_street" id="clinic_street" value="{{ old('clinic_street') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_street')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="clinic_suburb" class="block mb-2">Clinic Suburb</label>
            <input type="text" name="clinic_suburb" id="clinic_suburb" value="{{ old('clinic_suburb') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_suburb')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="clinic_postcode" class="block mb-2">Clinic Postcode</label>
            <input type="text" name="clinic_postcode" id="clinic_postcode" value="{{ old('clinic_postcode') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_postcode')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="clinic_state" class="block mb-2">Clinic State</label>
            <input type="text" name="clinic_state" id="clinic_state" value="{{ old('clinic_state') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_state')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="clinic_geocode" class="block mb-2">Clinic Location</label>
            <input type="text" name="clinic_geocode" id="clinic_geocode" value="{{ old('clinic_geocode') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('clinic_geocode')
            <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Doctor</button>
    </form>
</div>
@endsection
