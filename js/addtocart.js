document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.basket');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const url = event.target.closest('a').href;

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    alert('Product added to cart');
                })
                .catch(error => console.error('Error:', error));
        });
    });
});