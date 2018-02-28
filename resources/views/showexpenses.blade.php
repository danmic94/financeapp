<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

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
</div>
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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