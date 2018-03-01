<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Chart</title>
    <meta name="description" content="data chart of lat week expenses">
    <meta name="author" content="data-chart">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" crossorigin="anonymous">

</head>

<body>
<div class="container">
    <div class="jumbotron mt-3">
        <h1 class="text-center">Chart</h1>
        <p class="lead text-center">Last weeks expenses in graphical form.</p>
    </div>
</div>

<div class="container">
    <canvas class="col-md-12" id="myChart" width="400" height="400"></canvas>
</div>

</br></br>

<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="/index.php">Finance App</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link disabled" href="/">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/chart">Chart<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>


<script src="{{ asset('js/jquery3.3.1.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap4.0.0.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/Chart.min.js') }}" crossorigin="anonymous"></script>
<script type="application/javascript">
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>-
</body>
</html>