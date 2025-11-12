@extends('adminauth.AdminDashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h3 class="text-3xl font-bold mb-6">Liste des Résidences</h3>

    @if($residences->isEmpty())
    <p>Aucune résidence trouvée.</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
        @foreach($residences as $residence)
        @php
        // Choisir l’image principale ou la première
        $mainImage = $residence->images->where('est_principale', true)->first()
        ?? $residence->images->sortBy('order')->first();
        $mainImageSrc = $mainImage
        ? asset($mainImage->chemin_image)
        : 'https://placehold.co/400x300/C0C0C0/333333?text=Image+Appartement';

        // Moyenne des notes
        $avgRating = $residence->reviews->avg('note');
        @endphp

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative">
                <img src="{{ $mainImageSrc }}" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 300px; object-fit: cover" ;
                    alt="{{ $residence->nom }}"
                    class="w-full h-48 object-cover"
                    onerror="this.onerror=null;this.src='https://placehold.co/400x300/C0C0C0/333333?text=Image+Appartement';">

                {{-- Badge Type --}}
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                    {{ $residence->type->name ?? 'Type non défini' }}
                </span>
            </div>

            <div class="p-4">
                {{-- Titre --}}
                <h2 class="text-lg font-semibold mb-1">{{ Str::limit($residence->nom, 40) }}</h2>

                {{-- Ville --}}
                <p class="text-gray-500 text-sm">{{ $residence->ville }}</p>

                {{-- Prix --}}
                <p class="text-blue-600 font-bold text-sm">
                    À partir de {{ number_format($residence->types->min('prix_base') ?? 0, 0, ',', ' ') }} XOF
                </p>

                {{-- Avis --}}
                <div class="flex items-center text-yellow-500 text-xs my-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=floor($avgRating ?? 0))
                        <i class="fas fa-star"></i>
                        @elseif ($i - floor($avgRating ?? 0) === 0.5)
                        <i class="fas fa-star-half-alt"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                        @endfor
                        <span class="ml-1 text-gray-600">({{ number_format($avgRating ?? 0, 1) }}/5)</span>
                </div>

                {{-- Boutons --}}
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('admin.residences.edit', $residence->id) }}"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-1 rounded">
                        Modifier
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection