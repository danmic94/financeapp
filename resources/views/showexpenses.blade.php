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
            <th scope="col">Action</th>
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
            <li class="nav-item">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                    New Cost
                </button>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="\">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="/chart">Chart</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="expenseModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModal">New Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="description">Expense description :</label>
                        <textarea type="text" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cost">Ammount :</label>
                        <input type="number" class="form-control" id="cost" placeholder="How much?">
                    </div>
                    <div class="form-group">
                        <label for="currency">Currency :</label>
                        <select class="form-control" id="currency">
                            <option value="RON" selected>RON</option>
                            <option value="EUR">EUR</option>
                            <option value="BGP">BGP</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" class="form-control" id="date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="newexpense" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


</body>
    <script src="{{ asset('js/jquery3.3.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap4.0.0.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/sweetalerts2.js') }}" crossorigin="anonymous"></script>
    <script type="application/javascript">
        var renderAjax = function(){
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
        };

        renderAjax();

        function renderTable(data) {
            var table = $('#main-content');
            var deleteRoute =  'http://localhost:8000/api/expenses/delete';
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
                table.append('<td>' + '<a class="container delete" href=' + deleteRoute + '?id=' +currentId +
                             '>' + '<img src=' + '{{ asset('x-circle.svg') }}' + '></a>' + '</td>');
                table.append('</tr>');

            }

            //Handling the delete action of expense entries
            $('a.delete').click(function(event) {
                event.preventDefault();
                var deleteUrl = $(event.currentTarget)[0].getAttribute('href');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.value) {

                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        crossDomain: true,
                        dataType: 'json',
                        success: function() {
                            swal(
                                'Deleted!',
                                'Your entry has been successfully deleted!',
                                'success'
                            );
                            location.reload();
                        },
                        error: function() {
                            swal(
                                'Failed!',
                                'Your entry was not deleted!',
                                'error'
                            )
                        }
                    });
                }
            })
            });
            ///////////////////////////////////////////////
            $('button#newexpense').click(function(event) {
                event.preventDefault();
                var createURL = 'http://localhost:8000/api/expense';
                var newExpense = {
                    'description':$('#description').val(),
                    'cost':$('#cost').val(),
                    'currency':$('#currency').val(),
                    'date':$('#date').val()
                };

                $.ajax({
                    url: createURL,
                    type: 'POST',
                    crossDomain: true,
                    data: newExpense,
                    dataType: 'json',
                    success: function() {
                        $('#formModal').modal('toggle');
                        swal(
                        'New entry created!',
                        'New expense was added to the database!',
                        'success'
                    );
                        location.reload();
                    },
                    error: function() {
                        $('#formModal').modal('toggle');
                        swal(
                        'Failed!',
                        'New expense was not created!',
                        'error'
                    );
                        location.reload();
                    }
                });
            });

        }

    </script>
</html>