document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    const zoomableImages = document.querySelectorAll('.zoomable-image');

    zoomableImages.forEach(image => {
        image.addEventListener('click', function() {
            modal.style.display = 'flex';
            modalImage.src = this.src;
        });
    });

    modal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    const seeMoreButtons = document.querySelectorAll('.see-more-comments');
    const seeLessButtons = document.querySelectorAll('.see-less-comments');

    seeMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const extraComments = this.parentElement.querySelector('.extra-comments');
            extraComments.style.display = 'block';
            this.style.display = 'none';
            const seeLessButton = this.parentElement.querySelector('.see-less-comments');
            seeLessButton.style.display = 'inline-block';
        });
    });

    seeLessButtons.forEach(button => {
        button.addEventListener('click', function() {
            const extraComments = this.parentElement.querySelector('.extra-comments');
            extraComments.style.display = 'none';
            this.style.display = 'none';
            const seeMoreButton = this.parentElement.querySelector('.see-more-comments');
            seeMoreButton.style.display = 'inline-block';
        });
    });
});