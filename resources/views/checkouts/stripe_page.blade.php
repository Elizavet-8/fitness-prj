<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница оплаты Stripe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<!-- Stripe Elements Placeholder -->
<div class="container-fluid d-flex flex-column text-center" style="gap: 10px">
    <h1>Подтверждение оплаты</h1>
    <div class="row d-flex">
        <div class="col-6">Услуга</div>
        <div class="col-6">Тест</div>
    </div>
    <div class="row d-flex">
        <div class="col-6">Цена:</div>
        <div class="col-6">316</div>
    </div>
    <label for="card-element">
        <h2>Информация о карте</h2>
    </label>
    <div id="card-element">

    </div>
    <button id="card-button" class="btn btn-success">
        Process Payment
    </button>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{env('STRIPE_KEY')}}');

    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        classes: {
            base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'
        }
    });

    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
            // Display "error.message" to the user...
        } else {
            // The card has been verified successfully...
        }
    });
</script>
</body>
</html>


@section('content')

@endsection

