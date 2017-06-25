
<!-- Head file -->

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Grouplend @yield('title')</title> <!-- CHANGE THIS TITLE FOR ITS PAGE -->

{{-- Comforta text. --}}
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

{{-- Favicon --}}
<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

{{ Html::style('css/styles.css') }}

@yield('stylesheets')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
{{--CHART SCRIPT---->>>>>>>--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@if(\Illuminate\Support\Facades\Auth::user())
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var incomes = <?php echo json_encode($incomes); ?>;
        for (var i in incomes['data']) {
            var data = google.visualization.arrayToDataTable([
                ['Transaction', 'Incomes', 'Expenses'],
                ['1', incomes['data'][i]['amount'], 60],
                ['2', incomes['data'][i]['amount'], 90],
                ['3', incomes['data'][i]['amount'], 75],
                ['4', incomes['data'][i]['amount'], 30]
            ]);
        }

        var options = {
            title: 'Your economy',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
</script>
@endif

