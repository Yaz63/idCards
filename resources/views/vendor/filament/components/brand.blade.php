@php
$logo = "storage/".\App\Models\Location::where('id', 1)->first()->logo ?? 'img/logo.jfif';
@endphp
<img src="{{ asset($logo)}}" alt="Logo" class="h-10">
