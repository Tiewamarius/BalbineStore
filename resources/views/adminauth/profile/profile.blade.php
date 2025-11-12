@extends('adminauth.AdminDashboard')

@section('content')
<div class="w-full px-6 mx-auto">
    <!-- HEADER IMAGE -->
    <div class="relative flex items-center p-0 mt-2 overflow-hidden bg-center bg-cover min-h-45 rounded-2xl"
        style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
        <span class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
    </div>

    <!-- PROFILE CARD -->
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden shadow-blur rounded-2xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap -mx-3 items-center">
            <!-- Avatar -->
            <div class="flex-none w-auto max-w-full px-3">
                <div class="h-20 w-20 relative inline-flex items-center justify-center rounded-xl bg-gray-200">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/img/default-avatar.png') }}"
                        alt="profile_image"
                        class="w-full h-full object-cover rounded-xl shadow-soft-sm" />
                </div>
            </div>

            <!-- User Info -->
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="mb-0 font-semibold leading-normal text-sm">
                        {{ Auth::user()->role }}
                    </p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="w-full max-w-full px-3 mx-auto mt-4 sm:ml-auto md:w-1/2 lg:w-4/12">
                <div class="relative right-0">
                    <ul class="flex p-1 bg-gray-100 rounded-xl" role="tablist">
                        <li class="flex-1 text-center">
                            <a class="block w-full px-3 py-2 rounded-lg text-slate-700 active-tab"
                                data-tab="app">
                                App
                            </a>
                        </li>
                        <li class="flex-1 text-center">
                            <a class="block w-full px-3 py-2 rounded-lg text-slate-700"
                                data-tab="messages">
                                Messages
                            </a>
                        </li>
                        <li class="flex-1 text-center">
                            <a class="block w-full px-3 py-2 rounded-lg text-slate-700"
                                data-tab="settings">
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- TAB CONTENT -->
        <div class="mt-6">
            <!-- Messages -->
            <div id="tab-messages" class="tab-content hidden">
                <h6 class="font-bold mb-3">Avis récents</h6>

                @forelse($reviews as $review)
                <div class="p-3 mb-2 bg-gray-50 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-700">{{ $review->comment }}</p>
                    <span class="text-xs text-gray-500">
                        ⭐ {{ $review->rating }}/5
                        — par {{ $review->user->name ?? 'Utilisateur anonyme' }}
                        le {{ $review->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>
                @empty
                <p class="text-sm text-gray-500">Aucun avis trouvé.</p>
                @endforelse
            </div>


            <!-- Settings -->
            <div id="tab-settings" class="tab-content hidden">
                <h6 class="font-bold mb-3">Modifier mes coordonnées</h6>
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" value="{{ old('name', $admin->name) }}">
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}">

                    <button type="submit">Mettre à jour</button>
                </form>

            </div>

            <!-- Default App -->
            <div id="tab-app" class="tab-content">
                <h6 class="font-bold mb-3">Dashboard</h6>
                <p class="text-sm text-gray-600">Bienvenue dans l’espace d’administration.</p>
            </div>
        </div>
    </div>
</div>

<!-- SIMPLE SCRIPT POUR SWITCHER LES TABS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('[data-tab]');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // désactive tous les tabs
                tabs.forEach(t => t.classList.remove('active-tab', 'bg-white', 'shadow'));
                // masque tout le contenu
                contents.forEach(c => c.classList.add('hidden'));

                // active le bon tab
                tab.classList.add('active-tab', 'bg-white', 'shadow');
                document.getElementById('tab-' + tab.dataset.tab).classList.remove('hidden');
            });
        });
    });
</script>
@endsection