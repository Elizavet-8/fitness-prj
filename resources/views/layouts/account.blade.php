<!doctype html>
<html lang="en">
@section('head')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @if(Auth::user())
        <meta name="userInfo" content="{{Auth::user()->id}}">
        @else
        <meta name="userInfo" content="">
        @endif
        <title>{{ config('app.name', 'GoodDiets') }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
        />
        <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    </head>
@show

<body>
<div class="wrapper wrapper-account" id='app'>
    @section('content')

    @show
</div>

@section('footerScript')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function () {
            $('svg.radial-progress').each(function (index, value) {
                $(this).find($('circle.complete')).removeAttr('style');
            });
            $(window).scroll(function () {
                $('svg.radial-progress').each(function (index, value) {
                    if (
                        $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
                        $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
                    ) {
                        percent = $(value).data('percentage');
                        radius = $(this).find($('circle.complete')).attr('r');
                        circumference = 2 * Math.PI * radius;
                        strokeDashOffset = circumference - ((percent * circumference) / 100);
                        $(this).find($('circle.complete')).animate({ 'stroke-dashoffset': strokeDashOffset }, 1250);
                        $('.progress-level__current').html('(' + percent + '%' + ')');
                    }
                });
            }).trigger('scroll');
        });
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
@show
</body>
</html>
