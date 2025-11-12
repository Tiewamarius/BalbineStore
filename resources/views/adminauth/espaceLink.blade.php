@extends('adminauth.AdminDashboard')

@section('title', 'Liens utiles')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">📌 Liste de liens utiles</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="https://www.microsoft.com" target="_blank" rel="noopener noreferrer"
            class="block p-3 rounded-lg bg-blue-100 hover:bg-blue-200 transition">
            🪟 Microsoft
        </a>

        <a href="https://www.booking.com" target="_blank" rel="noopener noreferrer"
            class="block p-3 rounded-lg bg-green-100 hover:bg-green-200 transition">
            🏨 Booking.com
        </a>

        <a href="https://www.balbine.net" target="_blank" rel="noopener noreferrer"
            class="block p-3 rounded-lg bg-purple-100 hover:bg-purple-200 transition">
            🌐 Balbine.net
        </a>

        <a href="https://store.balbine.net" target="_blank" rel="noopener noreferrer"
            class="block p-3 rounded-lg bg-pink-100 hover:bg-pink-200 transition">
            🛍️ Balbine Store
        </a>
    </div>
</div>
@endsection