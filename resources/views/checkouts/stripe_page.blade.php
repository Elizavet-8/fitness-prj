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
<!--Stripe Elements Placeholder-->
<div class="container-fluid d-flex flex-column text-center" style="gap: 10px">
    <h1>Подтверждение оплаты</h1>
    <h2>Информация о покупателе</h2>
    <div class="row d-flex">
        <div class="col-6">Имя:</div>
        <div class="col-6">{{$userInfo->name}}</div>
    </div>
    <div class="row d-flex">
        <div class="col-6">Email:</div>
        <div class="col-6">{{$userInfo->email}}</div>
    </div>
    <h2>Информация об услуге</h2>
    <div class="row d-flex">
        <div class="col-6">Услуга:</div>
        <div class="col-6">{{$userInfo->product_name}}</div>
    </div>
    <div class="row d-flex">
        <div class="col-6">Цена:</div>
        <div class="col-6">{{$userInfo->price}} ₽</div>
    </div>
    {{ $checkout->button('Оплатить') }}
    <script src="https://js.stripe.com/v3/"></script>
</div>
</body>
</html>


@section('content')

@endsection
