<!doctype html>
<html lang="vie">
    <meta charset="utf-8">
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
       <div class="time">
        <p>Thống kê đơn hàng tháng </p>
        <form action="/admin/tkantainha">
            <select id="month" name="month">
                @for($i=1;$i<13;$i++)
                @if ($i == $month)
                <option selected>{{ $i }}</option>
                @else
                <option>{{ $i }}</option>
                @endif
                @endfor
            </select>
             năm 
            <select id="year" name="year">
                <option>2024</option>
            </select>
            <button class="btn btn-primary" type="submit">Chọn</button>
        </form>
       </div>
       @endsection
       @section('content')
       <h5>Duyệt đơn</h5>
       <div>
        <canvas id="myChart1"></canvas>
      </div>
       <h5>Nấu đơn</h5>
       <div>
        <canvas id="myChart2"></canvas>
      </div>
       <h5>Vận chuyển</h5>
       <div>
        <canvas id="myChart3"></canvas>
      </div>
       
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx1 = document.getElementById('myChart1');
        var JsonCheck = '{{ $JsonCheck }}';
        JsonCheck = JsonCheck.replaceAll("&quot;", '"');
        JsonCheck = JSON.parse(JsonCheck);
        new Chart(ctx1, {
          type: 'bar',
          data: {
            labels: JsonCheck,
            datasets: [{
              label: '# of Votes',
              data: {{ $JsonNumCheck }},
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
       <script>
        const ctx2 = document.getElementById('myChart2');
        var JsonCook = '{{ $JsonCook }}';
        JsonCook = JsonCook.replaceAll("&quot;", '"');
        JsonCook = JSON.parse(JsonCook);
        new Chart(ctx2, {
          type: 'bar',
          data: {
            labels: JsonCook,
            datasets: [{
              label: '# of Votes',
              data: {{ $JsonNumCook }},
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
      <script>
        const ctx3 = document.getElementById('myChart3');
        var JsonShip = '{{ $JsonShip }}';
        JsonShip = JsonShip.replaceAll("&quot;", '"');
        JsonShip = JSON.parse(JsonShip);
        new Chart(ctx3, {
          type: 'bar',
          data: {
            labels: JsonShip,
            datasets: [{
              label: '# of Votes',
              data: {{ $JsonNumShip }},
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

