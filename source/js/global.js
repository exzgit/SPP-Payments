function showTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(tabId).classList.remove('hidden');
    localStorage.setItem('activeTab', tabId);
}

document.addEventListener('DOMContentLoaded', function() {
    const activeTab = localStorage.getItem('activeTab') || 'dashboard';
    showTab(activeTab);
});




document.addEventListener('DOMContentLoaded', function() {
    const messageContainer = document.getElementById('message-container');
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    if (message) {
        messageContainer.innerHTML = `
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">Peringatan:</span> ${decodeURIComponent(message)}
            </div>
        `;
    }

    const classInput = document.getElementById('class');
    const suggestions = document.getElementById('suggestions');

    classInput.addEventListener('input', function() {
        const query = this.value;

        if (query.length > 0) {
            fetch(`../php/get_classes.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        suggestions.innerHTML = data.map(className => 
                            `<div class="autocomplete-suggestion" data-class="${className}">${className}</div>`
                        ).join('');
                    } else {
                        suggestions.innerHTML = `<div class="autocomplete-suggestion">Kelas tidak ada</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching classes:', error);
                    suggestions.innerHTML = `<div class="autocomplete-suggestion">Terjadi kesalahan</div>`;
                });
        } else {
            suggestions.innerHTML = '';
        }
    });

    suggestions.addEventListener('click', function(event) {
        if (event.target.classList.contains('autocomplete-suggestion')) {
            classInput.value = event.target.getAttribute('data-class');
            suggestions.innerHTML = '';
        }
    });
});



document.addEventListener('DOMContentLoaded', function() {
    const messageContainer = document.getElementById('message-container-payments');
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    const status = urlParams.get('status');

    if (message) {
        if(status == 'error'){
            messageContainer.innerHTML = `
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">Peringatan:</span> ${decodeURIComponent(message)}
            </div>
        `;
        }else{
            messageContainer.innerHTML = `
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="success">
                <span class="font-medium">Peringatan:</span> ${decodeURIComponent(message)}
            </div>
        `;
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const nisnInput = document.getElementById('nisn');
    const classInput = document.getElementById('class');
    const suggestionsContainer = document.getElementById('suggestions_siswa');

    

    nameInput.addEventListener('input', function() {
        const query = this.value;

        if (query.length > 0) {
            fetch(`../php/get_students.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = data.length > 0 ?
                        data.map(student => 
                            `<div class="autocomplete-suggestion" data-nisn="${student.Nisn}" data-class="${student.Kelas}">${student.NamaSiswa}</div>`
                        ).join('') :
                        `<div class="autocomplete-suggestion">Tidak ada data</div>`;
                })
                .catch(error => console.error('Error fetching students:', error));
        } else {
            suggestionsContainer.innerHTML = '';
        }
    });

    suggestionsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('autocomplete-suggestion')) {
            const selectedName = event.target.textContent;
            const selectedNisn = event.target.getAttribute('data-nisn');
            const selectedClass = event.target.getAttribute('data-class');

            nameInput.value = selectedName;
            nisnInput.value = selectedNisn;
            classInput.value = selectedClass;

            suggestionsContainer.innerHTML = '';
        }
    });
});