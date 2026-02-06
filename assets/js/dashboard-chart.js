document.addEventListener("DOMContentLoaded", function() {
    const chartCanvas = document.getElementById('absenChart');
    
    if (chartCanvas) {
        // Ambil data dari atribut 'data-stats' yang kita buat di HTML nanti
        const stats = JSON.parse(chartCanvas.getAttribute('data-stats'));

        const ctx = chartCanvas.getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpha'],
                datasets: [{
                    data: [stats.h, stats.s, stats.i, stats.a],
                    backgroundColor: ['#198754', '#0dcaf0', '#ffc107', '#dc3545']
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } } 
            }
        });
    }
});