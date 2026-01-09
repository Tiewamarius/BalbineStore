@extends('admin.AdminDashboard')
@section('content')
<div class="row">
    <div class="ms-3 mb-4">
        <h3 class="mb-2 h4 font-weight-bolder">Dashboard</h3>

        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="date"
                    name="start_date"
                    value="{{ request('start_date', $startDate->format('Y-m-d')) }}"
                    class="form-control">
            </div>

            <div class="col-md-3">
                <input type="date"
                    name="end_date"
                    value="{{ request('end_date', $endDate->format('Y-m-d')) }}"
                    class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn bg-gradient-dark w-100">
                    Filtrer
                </button>
            </div>
        </form>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Total Vente</p>
                        <h4 class="mb-0">
                            {{ number_format($totalSales, 0, ',', ' ') }} FCFA
                        </h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">payments</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <!-- <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
            </div> -->
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Commandes</p>
                        <h4 class="mb-0">
                            {{ number_format($totalOrders) }}
                        </h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">person</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <!-- <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
            </div> -->
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Clients</p>
                        <h4 class="mb-0">
                            {{ number_format($totalClients) }}
                        </h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">leaderboard</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <!-- <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
            </div> -->
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Livraison</p>
                        <h4 class="mb-0">
                            {{ number_format($todaySales, 0, ',', ' ') }} FCFA
                        </h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">weekend</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <!-- <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
            </div> -->
        </div>
    </div>

</div>
<!-- Courbe -->
<div class="row mt-4" bis_skin_checked="1">
    <div class="col-lg-8" bis_skin_checked="1">
        <div class="card h-100" bis_skin_checked="1">
            <div class="card-header pb-0 p-3" bis_skin_checked="1">
                <div class="d-flex justify-content-between" bis_skin_checked="1">
                    <h6 class="mb-0">Statistique des ventes</h6>
                </div>
            </div>
            <div class="card-body p-3" bis_skin_checked="1">
                @if($salesChart->isEmpty())
                <div class="alert alert-warning">
                    Aucune donnée de vente pour cette période
                </div>
                @endif
                <div class="chart" bis_skin_checked="1">
                    <canvas id="salesChart"></canvas>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-lg-0 mt-4" bis_skin_checked="1">
        <div class="card" bis_skin_checked="1">
            <div class="card-header pb-0 p-3" bis_skin_checked="1">
                <div class="d-flex justify-content-between" bis_skin_checked="1">
                    <h6 class="mb-0">Stat. Commandes</h6>
                </div>
            </div>
            <div class="card-body p-3" bis_skin_checked="1">
                <div class="chart" bis_skin_checked="1">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4" bis_skin_checked="1">
    <div class="col-12" bis_skin_checked="1">
        <div class="card mb-4" bis_skin_checked="1">
            <div class="card-header pb-0" bis_skin_checked="1">
                <h6>Les Top produits commandés</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2" bis_skin_checked="1">
                <div class="table-responsive p-0" bis_skin_checked="1">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Value</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ads Spent</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Refunds</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1" bis_skin_checked="1">
                                        <div bis_skin_checked="1">
                                            <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/blue-shoe.jpg" class="avatar me-3" alt="image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center" bis_skin_checked="1">
                                            <h6 class="mb-0 text-sm">Nike v22 Running</h6>
                                            <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success">8.232</span> orders</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">$130.992</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm font-weight-normal mb-0">$9.500</p>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center" bis_skin_checked="1">
                                        <p class="text-sm font-weight-normal mb-0">13</p>
                                        <i class="ni ni-bold-down text-sm ms-1 text-success"></i>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Les plus vendus</h6>

                    </div>

                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Material XD Version</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="avatar-group mt-2">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                            <img src="../assets/img/team-1.jpg" alt="team1">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                            <img src="../assets/img/team-2.jpg" alt="team2">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                                            <img src="../assets/img/team-3.jpg" alt="team3">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                            <img src="../assets/img/team-4.jpg" alt="team4">
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> $14,000 </span>
                                </td>
                                <td class="align-middle">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">60%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Avis & Commentaire</h6>
                <p class="text-sm">
                    <!-- <i class="fa fa-arrow-up text-success" aria-hidden="true"></i> -->
                    <!-- <span class="font-weight-bold">24%</span> this month -->
                </p>
            </div>
            <div class="card-body p-3">
                @foreach($notifications as $notification)
                <div class="timeline-block mb-3 d-flex align-items-start">
                    <div class="me-3">
                        <img src="{{ $notification->user->profile_photo ?? 'https://via.placeholder.com/40' }}"
                            alt="{{ $notification->user->name }}"
                            class="rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    </div>
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                {{ $notification->user->name }}
                            </h6>
                            <span class="text-xs text-secondary">{{ $notification->created_at->format('d M H:i') }}</span>
                        </div>
                        <p class="text-sm text-secondary mt-1 mb-0">
                            <strong>{{ $notification->title }}:</strong> {{ $notification->message }}
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<!-- end cards -->
@endsection