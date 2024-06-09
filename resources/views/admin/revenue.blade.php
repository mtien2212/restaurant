<html lang="vie">
    <head>
       <style>
            .new{
                display: flex;
                justify-content: space-between;
                margin: 10px;
            }
            .message{
              visibility: hidden;
            }
            .error{
              color: red;
              visibility :visible;
            }
            .time{
                display: flex;
                justify-content: flex-start;
            }
       </style>
       <script src="../js/category.js"></script>
    </head>
    <body>
       @extends('layouts.admin')
       @section('head')
       Thống kê doanh thu
       @endsection
       @section('content')
       <div class="time">
        <h5>Doanh thu các tháng trong năm: </h5>
        <form action="/admin/doanhthu">
            <select id="year" name="year">
                <option>2024</option>
            </select>
            <button class="btn btn-primary" type="submit">Chọn</button>
        </form>
       </div>
       <div>
        <canvas id="myChart"></canvas>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['1','2','3','4','5','6','7','8','9','10','11','12'],
            datasets: [{
              label: '# of Votes',
              data: {{ $listInvoice }},
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
       
       @endsection
    </body>
</html>

