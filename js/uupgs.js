console.log('uupgs.js loaded');
(function() {
    let uupgs = []
    let loading = true;

    getUUPGs();



    function renderUUPGs(uupgs) {
        const uupgsContainer = document.getElementById('uupgs-container');
        uupgsContainer.innerHTML = '';
        uupgs.forEach(uupg => {
            const uupgCard = document.createElement('div');
            uupgCard.classList.add('uupg-card');
            uupgCard.innerHTML = `
            <h3>${uupg.name}</h3>
            <p>${uupg.description}</p>
            `
        });
    }
})();
