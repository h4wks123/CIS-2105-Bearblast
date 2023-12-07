function closeContainer() {
    var errorContainer = document.querySelector(".error-container");
    errorContainer.style.display = "none";
}

function incrementCounter(btn) {
    var wrapperEl = btn.parentNode;
    var numEl = wrapperEl.querySelector('.num');
    var quantity = parseInt(numEl.value);
    quantity += 1;
    numEl.value = quantity;
    event.preventDefault();
}

function decrementCounter(btn) {
    var wrapperEl = btn.parentNode;
    var numEl = wrapperEl.querySelector('.num');
    var quantity = parseInt(numEl.value);
    if (quantity > 0) {
        quantity -= 1;
    }
    numEl.value = quantity;
    event.preventDefault();
}

function Avail2(btn) {
    if (btn.name === 'unavailable2') {
        btn.name = 'available2';
        btn.classList.remove('btn-warning');
        btn.classList.add('btn-info');
        btn.textContent = 'Available';
    } else {
        btn.name = 'unavailable2';
        btn.classList.remove('btn-info');
        btn.classList.add('btn-warning');
        btn.textContent = 'Unavailable';
    }
    event.preventDefault();
    return true;
}