document.addEventListener("DOMContentLoaded", function () {

    if (!window.salesChartData || !document.getElementById('salesChart')) {
        console.warn('Données ou canvas manquant');
        return;
    }

    const labels = window.salesChartData.map(item => item.date);
    const totals = window.salesChartData.map(item => item.total);

    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventes (FCFA)',
                data: totals,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
