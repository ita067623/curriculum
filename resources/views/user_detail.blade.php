@extends('layouts.app')

@section('content')

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <a href="{{ route('user.edit', ['id' => $user->id]) }}">
        <img src="{{ $user->image }}" alt="現在のアイコン画像" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
        </a>

        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">{{ $user->name }}</h1>

        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Profile Section -->
        <div class="mt-4">
            <h2 class="text-uppercase">自己紹介</h2>
            <p class="lead">{{ $user->profile }}</p>
        </div>
    </div>
</header>

@endsection
