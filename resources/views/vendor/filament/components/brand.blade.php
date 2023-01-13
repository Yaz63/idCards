@php
$logo = 'img/logo.jfif';
if(isset(\App\Models\Location::first()->logo) && !empty(\App\Models\Location::first()->logo )){
    $logo = "storage/".(\App\Models\Location::first()->logo;
}
@endphp
<img src="{{ asset($logo)}}" alt="Logo" class="h-10">
