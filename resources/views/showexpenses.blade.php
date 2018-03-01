<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Expenses</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="jumbotron mt-3">
        <h1 class="text-center">All data</h1>
        <p class="lead text-center">All expenses data using ajax call and JavaScript to generate the table.</p>
        <p class="lead text-center">Extracted form /api/expenses endpoint.</p>
    </div>
</div>


<div class="container">
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Description</th>
            <th scope="col">Cost</th>
            <th scope="col">Currency</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody id="main-content">
        {{--JavaScript Rendered Table form API route call api/expenses --}}
        </tbody>
    </table>
    </br></br>
</div>
<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Finance App</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="/chart">Chart</a>
            </li>
        </ul>
    </div>
</nav>
</body>
    <script src="{{ asset('js/jquery3.3.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap4.0.0.min.js') }}" crossorigin="anonymous"></script>
    <script type="application/javascript">

        // <tr>
        // <th scope="row">1</th>
        //     <td>Mark</td>
        //     <td>Otto</td>
        //     <td>@mdo</td>
        // </tr>

        function renderTable(data) {
            var table = $('#main-content');
            //Process the data into nice table rows to be appended to HTML Table
            for (var i = 0, len = data.length; i < len; i++) {

                var currentId = data[i].id;
                var currentDescription = data[i].description;
                var currentCost = data[i].cost;
                var currentCurrency = data[i].currency;
                var currentDate = data[i].date;

                table.append('<tr>');
                table.append('<th scope="row">' + currentId + '</th>');
                table.append('<td width="65%">' + currentDescription + '</td>');
                table.append('<td>' + currentCost + '</td>');
                table.append('<td>' + currentCurrency + '</td>');
                table.append('<td>' + currentDate + '</td>');
                table.append('</tr>');

            }

        }

        $(document).ready(function(){
                $.ajax({
                    url: 'http://localhost:8000/api/expenses',
                    type: 'GET',
                    crossDomain: true,
                    dataType: 'json',
                    success: function(result) { renderTable(result); },
                    error: function() { alert('Table rendering Failed!'); }
                });
        });

    </script>
</html>