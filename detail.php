<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  if (isset($_SESSION['access_token'])) {
    include('navbar.php');
    $ID = $_SESSION['id'];


  ?>
    <div class="container">
      <h1>Daily Price</h1>
      <div class="card text-center">
        <div class="card-header">
          <h1 id="symbol"></h1>
        </div>
        <div class="card-body">





          <ul class="list-group list-group-flush">

            <li class="list-group-item">$ <span id="price"></span>
              <br>
              <div class="high_price">
                <span class="sign"></span>$ <span id="change"></span>
                (<span class="sign"></span> <span id="change_percent"></span>)
              </div>
            </li>




            <li class="list-group-item">
              <div class="row">
                <div class="col-6">Open: $<span id="open"></span></div>
                <div class="col-6">Close: $<span id="close"></span></div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-6">High: $<span id="high"></span></div>
                <div class="col-6">Low: $<span id="low"></span></div>
              </div>
            </li>
          </ul>
          <input type="number" id="num" placeholder="amount">
          <input type="button" id="buy" value="BUY" class="btn btn-primary">

        </div>
        <div class="card-footer text-muted">
          Last Trading Day:<span id="date"></span>
        </div>
      </div>
      <h1>History</h1>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Open</th>
            <th scope="col">Close</th>
            <th scope="col">High</th>
            <th scope="col">Low</th>
            <th scope="col">Volume</th>
          </tr>
        </thead>
        <tbody id="table">

        </tbody>
      </table>
    </div><?php
        } else {
          header('Location: index.php');
        }

          ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    var url_str = window.location.href;
    var url = new URL(url_str);
    var symbol = url.searchParams.get("symbol");
    var API_Key = "ARPNKQMH23YF736Z";
    getdata('TIME_SERIES_DAILY');
    getdata('GLOBAL_QUOTE');

    function getdata(functionType) {
      $.ajax({
        url: "https://www.alphavantage.co/query",
        data: {
          function: functionType,
          symbol: symbol,
          apikey: API_Key
        },
        dataType: 'json',
        method: 'GET',
        success: function(data) {
          console.log(data);
          if (functionType == 'GLOBAL_QUOTE') {
            $('#symbol').html(data['Global Quote']['01. symbol']);
            $('#price').html(data['Global Quote']['05. price']);
            $('#change').html(data['Global Quote']['09. change']);
            $('#change_percent').html(data['Global Quote']['10. change percent']);
            $('#open').html(data['Global Quote']['02. open']);
            $('#close').html(data['Global Quote']['08. previous close']);
            $('#high').html(data['Global Quote']['03. high']);
            $('#low').html(data['Global Quote']['04. low']);
            $('#date').html(data['Global Quote']['07. latest trading day']);
            var change = data['Global Quote']['09. change'];
            if (change < 0) {
              $('.sign').html("&#11206;");
              $('.high_price').addClass('down');
            } else {
              $('.sign').html("&#11205;");
              $('.high_price').addClass('up');
            }
          } else {
            var a = "";
            Object.keys(data['Time Series (Daily)']).forEach(function(date) {
              var s = data['Time Series (Daily)'][date]
              console.log(s);
              a += `<tr>
                <th scope="row">${date}</th>
                <td> ${s['1. open']}</td>
                <td> ${s['4. close']}</td>
                <td> ${s['2. high']}</td>
                <td> ${s['3. low']}</td>
                <td> ${s['5. volume']}</td>
                </tr>`



            })
            $('#table').html(a);

          }

        }

      })
    }
    $('#buy').click(function() {
      var amount = $('#num').val();
      var price = $('#price').html();
      var id = '<?php echo $ID; ?>';
      var symbol = $('#symbol').html();

      $.ajax({
        url: 'addStock.php',
        data: {
          amount: amount,
          price: price,
          id: id,
          symbol: symbol
        },
        method: 'GET',
        success: function() {
          window.location.replace("index.php");


        }
      })
    })
  </script>

</body>

</html>