const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

const rentalCreateModal = document.getElementById('rentalCreateModal');
if (rentalCreateModal) {
    rentalCreateModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const formatId = button.getAttribute('data-bs-format-id')
        const formatName = button.getAttribute('data-bs-format-name')
        const movieId = button.getAttribute('data-bs-movie-id')
        const movieTitle = button.getAttribute('data-bs-movie-title')

        const movieIdInput = rentalCreateModal.querySelector('.modal-body #movie')
        const movieTitleInput = rentalCreateModal.querySelector('.modal-body #movie-title')

        movieIdInput.value = movieId;
        movieTitleInput.value = movieTitle;

        const formatIdInput = rentalCreateModal.querySelector('.modal-body #format')
        const formatTitleInput = rentalCreateModal.querySelector('.modal-body #format-name')

        formatIdInput.value = formatId;
        formatTitleInput.value = formatName;
    })
}