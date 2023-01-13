@php
$logo = "storage/".\App\Models\Location::first()->logo ?? 'img/logo.jfif';
@endphp
<img src="{{ asset($logo)}}" alt="Logo" class="h-10">
