<html>
    <head>
       
    </head>
    <body>
        @extends('layouts.admin')
       @section('content')
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Age</th>
              <th>City</th>
              <th>Country</th>
              <th>Sex</th>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Anna</td>
              <td>Pitt</td>
              <td>35</td>
              <td>New York</td>
              <td>USA</td>
              <td>Female</td>
            </tr>
          </tbody>
        </table>
      </div>
       @endsection
    </body>
</html>

