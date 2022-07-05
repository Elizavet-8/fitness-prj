function sendMarathonInfo(name, price, stripe_id, menu_id, training_id) {
    console.log(window.Buy);
    window.Buy.price = 5000;
    localStorage.setItem('name', name);
    localStorage.setItem('price', price);
    localStorage.setItem('stripe_id', stripe_id);
    localStorage.setItem('menu_id', menu_id);
    localStorage.setItem('training_id', training_id);
}


