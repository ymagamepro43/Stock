<?php
include('config.php');
// $client->revokeToken(array($_SESSION['access_token']));
// session_destroy();
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($client);
        $usersdata = $google_service->userinfo->get();
        if (!empty($usersdata['email'])) {
            $_SESSION['email'] = $usersdata['email'];
        }
        if (!empty($usersdata['family_name'])) {
            $_SESSION['family_name'] = $usersdata['family_name'];
        }
        if (!empty($usersdata['given_name'])) {
            $_SESSION['given_name'] = $usersdata['given_name'];
        }
        if (!empty($usersdata['id'])) {
            $_SESSION['id'] = $usersdata['id'];
        }
        $ID = $_SESSION['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .bg-image {
            /* The image used */
            background-image: url("photographer.jpg");

            /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(8px);

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Position text in the middle of the page/image */
        .bg-text {
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/opacity/see-through */
            color: white;
            font-weight: bold;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 20px;
            text-align: center;
        }

        .login-with-google-btn {
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 12px 16px 12px 42px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
            color: #757575;
            font-size: 14px;
            font-weight: 500;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
            background-color: white;
            background-repeat: no-repeat;
            background-position: 12px 11px;
        }

        .login-with-google-btn:hover {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
        }

        .login-with-google-btn:active {
            background-color: #eeeeee;
        }

        .login-with-google-btn:focus {
            outline: none;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25), 0 0 0 3px #c8dafc;
        }
    </style>
</head>

<body>


    <?php
    if (isset($_SESSION['access_token'])) {
        include('navbar.php');
        $ID = $_SESSION['id'];

    ?>
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center mt-3">Search</h1>
                <div class="card text-center hoverable" style="width: 35rem;">
                    <div class="card-body">
                        <div class="card-text ">
                            <div class="form-group">
                                <label for="search company">Company</label>
                                <input type="text" class="form-control" id="search" aria-describedby="company" placeholder="Enter your company" onchange="fetchAPI()">
                                <br>

                            </div>
                        </div>
                    </div>
                    <div id="result"></div>
                </div>
            </div>
            <div id="table">

            </div>
        </div>

    <?php } else {

        echo '    <div class="bg-image"></div>

        <div class="bg-text">
          <h1 style="font-size:50px">Login</h1>
          <p>Welcome Login</p>
          
          <a href="' . $client->createAuthUrl() . '">
          <button type="button" class="login-with-google-btn" >
            Sign in with Google
          </button></a>
        </div>';
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var URL = "https://www.alphavantage.co/query?";
        var API_Key = "ARPNKQMH23YF736Z";
        var functionType = 'SYMBOL_SEARCH';

        onload = function() {
            var id = '<?php echo $ID ?>';
            $.ajax({
                url: 'select.php',
                data: {
                    id: id
                },

                dataType: 'XML',

                success: function(data) {
                    var xml = $(data);
                    var stocks = xml.find('stock');
                    var table = `<table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Symbol</th>
            <th scope="col">Amount</th>
            <th scope="col">Price</th>
            <th scope="col">Date_Time</th>
            <th scope+"col" >Delete Data</th>
          </tr>
        </thead>
        <tbody id="table">`;
                    stocks.each(function() {
                        table += `
                        <tr>
                        <td class="symbol">${$(this).find('Symbol').text()}</td>
                        <td class="amount">${$(this).find('Amount').text()}</td>
                        <td class="price">${$(this).find('Price').text()}</td>
                        <td class="datetime">${$(this).find('Date_Time').text()}</td>
                        <td><input type="button" class="deletebutton" value="delete"></td>
                        </tr>
                        `;
                    });
                    table += `</tbody>
                    </table>`;
                    $('#table').html(table);
                }



            })


        }

        function fetchAPI() {
            $.ajax({
                url: URL,
                method: "GET",
                dataType: 'json',
                data: {
                    function: functionType,
                    keywords: $('#search').val(),
                    apikey: API_Key

                },
                success: function(data) {
                    console.log(data);
                    var html = "";
                    for (var i = 0; i < data.bestMatches.length; i++) {
                        html += `<a href="detail.php?symbol=${data.bestMatches[i]['1. symbol']}">${data.bestMatches[i]['1. symbol']}</a>
                        <h4> ${data.bestMatches[i]['2. name']}</h4>
                        <h5> ${data.bestMatches[i]['8. currency']}</h5>
                        <hr>`;
                    }
                    $('#result').html(html);
                }
            });

        }
        $(document).ready(function() {
            $("#table").on('click', '.deletebutton', function() {
                var currentrow = $(this).closest('tr');
                var symbol = currentrow.find('td:eq(0)').html()
                var amount = currentrow.find('td:eq(1)').html()
                var price = currentrow.find('td:eq(2)').html()
                var id = '<?php echo $ID; ?>'
                $.ajax({
                    url: 'delete.php',
                    data: {
                        symbol: symbol,
                        amount: amount,
                        price: price,
                        id: id,
                    },
                    method: 'GET',
                    success: function() {
                        location.reload();
                    }
                })
            })
        })
    </script>


</body>

</html>