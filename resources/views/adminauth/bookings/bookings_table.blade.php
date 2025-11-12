<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom" style="background-color: #d8cbd2ff;">
                            <tr>
                                <th></th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dates</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">N° Reservation</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Clients</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Appartements</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nb. personnes</th>
                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <span class="btnDetail">
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}">Details</a>
                                    </span>
                                </td>
                                <td class="p-2 text-sm text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @php
                                    $statutNom = '';
                                    $statusClass = '';

                                    switch ($booking->statut) {
                                    case 'Attente':
                                    $statutNom = 'Attente';
                                    $statusClass = 'status-attente';
                                    break;
                                    case 'Confirmé':
                                    $statutNom = 'Confirmé';
                                    $statusClass = 'status-confirme';
                                    break;
                                    case 'Encours':
                                    $statutNom = 'En séjour';
                                    $statusClass = 'status-encours';
                                    break;
                                    case 'checked_out':
                                    $statutNom = 'Parti';
                                    $statusClass = 'status-parti';
                                    break;
                                    case 'Terminé':
                                    $statutNom = 'Terminé';
                                    $statusClass = 'status-termine';
                                    break;
                                    case 'Annulé':
                                    $statutNom = 'Annulé';
                                    $statusClass = 'status-annule';
                                    break;
                                    default:
                                    $statutNom = 'Échec';
                                    $statusClass = 'status-echec';
                                    break;
                                    }
                                    @endphp

                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statutNom }}
                                    </span>
                                </td>

                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $booking->date_arrivee->format('d/m/y') }} au {{ $booking->date_depart->format('d/m/y') }}
                                    </span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $booking->numero_reservation }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $booking->user->name ?? 'N/A' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $booking->residence->nom ?? 'N/A' }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $booking->nombre_adultes }} adultes <mark>&</mark>{{ $booking->nombre_enfants }} enfants</p>

                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">

                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold leading-tight text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"> Supprimer </button>
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
@if ($bookings->lastPage() > 1)
<div class="pagination">
    {{ $bookings->withQueryString()->links() }}
</div>
@endif
<style>
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        color: #fff;
        text-align: center;
        min-width: 80px;
    }

    /* Statuts */
    .status-attente {
        background: linear-gradient(to right, #2563eb, #3b82f6);
        /* Bleu */
    }

    .status-confirme {
        background: linear-gradient(to right, #16a34a, #22c55e);
        /* Vert */
    }

    .status-encours {
        background: linear-gradient(to right, #f97316, #fb923c);
        /* Orange */
    }

    .status-parti {
        background: linear-gradient(to right, #0891b2, #22d3ee);
        /* Cyan */
    }

    .status-termine {
        background: linear-gradient(to right, #6b7280, #9ca3af);
        /* Gris */
    }

    .status-annule {
        background: linear-gradient(to right, #dc2626, #ef4444);
        /* Rouge foncé */
    }

    .status-echec {
        background: linear-gradient(to right, #b91c1c, #ef4444);
        /* Rouge dégradé */
    }

    .btnDetail {
        border: 0.5px solid black;
        border-radius: 10px;
        padding: 5px;
    }
</style>