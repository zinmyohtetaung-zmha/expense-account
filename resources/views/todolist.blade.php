<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .cardshadow {
            background-color: #06af1c23;
        }

        .cardshadow:hover {
            box-shadow: 2px 2px 3px 3px #12c029;
            transition: 0.5s;
        }

        .page-link {
            color: #198754 !important;
        }


        .page-item.active .page-link {
            background-color: #198754 !important;
            border-color: #198754 !important;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-success text-center mt-5 mb-3">Expense Account</h2>

        <div class="row">
            <div class="col-4">
                <div class="card cardshadow">
                    <div class="card-header text-center text-success">
                        <h6>Add Data Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('todolist') }}" method="POST">
                            @csrf
                            @method('POST')

                            <input type="date" name="date" class="form-control mb-3" id="dec"
                                placeholder="Description" required>

                            <input type="text" class="form-control mb-3" id="dec" placeholder="Description"
                                name="description" required>
                            <input type="number" class="form-control mb-3" id="amt" placeholder="Amount"
                                name="amount" required>
                            <select class="form-select mb-3" aria-label="Default select example" name="category"
                                required>
                                <option value="1">Cash</option>
                                <option value="2">K-pay</option>
                            </select>
                            <button type="submit" class="btn btn-success mb-3 w-100">ADD</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4 cardshadow">
                    <div class="card-header text-success text-center">
                        <h6>Your Total Expense</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-success h6">Total</div>
                            @if ($totalprice > 10000)
                                <div class="col-6 d-flex flex-row-reverse">MMK<span
                                        class="text-danger h5 mx-1">{{ $totalprice }}</span> </div>
                            @elseif ($totalprice > 5000)
                                <div class="col-6 d-flex flex-row-reverse">MMK<span
                                        class="text-warning h5 mx-1">{{ $totalprice }}</span> </div>
                            @else
                                <div class="col-6 d-flex flex-row-reverse">MMK<span
                                        class="text-success h5 mx-1">{{ $totalprice }}</span> </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-8">
                <div class="card cardshadow">
                    <div class="card-header text-success h5">
                        <div class="row">
                            <div class="col-6">
                                Your Daily List
                            </div>
                            <div class="col-6 d-flex flex-row-reverse">
                                <a href="{{ route('daily') }}">
                                    <button class="btn btn-success">Daily Report</button>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-success">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $lists['description'] }}</td>
                                        <td>{{ $lists['amount'] }}</td>

                                        @if ($lists['category'] == 1)
                                            <td>Cash</td>
                                        @else
                                            <td>K-pay</td>
                                        @endif

                                        <td>{{ $lists['date'] }}</td>
                                        <td>
                                            <a href="{{ route('edit', $lists['id']) }}" title="Edit"><i
                                                    class="fa-solid fa-square-pen h5 mt-1 mx-2 text-success"></i></a>
                                            <a href="{{ route('delete', $lists['id']) }}" title="Delete"><i
                                                    class="fa-solid fa-trash-can h5 mt-1 text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-center">{{ $list->links() }}</div>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script>
        // Get a reference to the date input element
        const dateInput = document.getElementById("dec");

        // Create a Date object for today's date
        const today = new Date();

        // Format the date to yyyy-MM-dd (which is the format the input expects)
        const formattedDate = today.toISOString().split('T')[0];

        // Set the input value to today's date
        dateInput.value = formattedDate;
    </script>
</body>

</html>
