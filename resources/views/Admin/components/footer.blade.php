<script>
        // Simple micro-interactions for the dashboard
        document.querySelectorAll('tr').forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.querySelector('td:nth-child(2) div').classList.add('scale-105', 'transition-transform');
            });
            row.addEventListener('mouseleave', () => {
                row.querySelector('td:nth-child(2) div').classList.remove('scale-105');
            });
        });

        // Search highlight simulation
        const searchInput = document.querySelector('input[placeholder="Cari nama lokasi..."]');
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(query)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>