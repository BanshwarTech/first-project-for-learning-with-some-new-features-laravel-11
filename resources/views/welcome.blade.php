<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>All User Details</h1>
<div class="table-responsive ms-5 me-5 mb-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->age }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
