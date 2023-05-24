<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-danger text-center " style="margin: 20px auto;">Supermarket Application</h1>
    <form method="post">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <label for="">Name</label>
                <input type="text" placeholder="Name" class="form-control" name="name" value=<?php if (isset($_POST['name'])) {
                                                                                                    echo $_POST['name'];
                                                                                                } else echo ''; ?>>
                <label for="">City</label>
                <select class="custom-select" name="city">
                    <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Cairo') {
                                echo 'selected';
                            } else echo ''; ?> value="Cairo">Cairo</option>
                    <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Giza') {
                                echo 'selected';
                            } else echo ''; ?> value="Gizq">Giza</option>
                    <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Alex') {
                                echo 'selected';
                            } else echo ''; ?> value="Alex">Alex</option>
                    <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Others') {
                                echo 'selected';
                            } else echo ''; ?> value="Others">Others</option>
                </select>
                <label for="">Number of products</label>
                <input type="number" placeholder=" Enter number of products " class="form-control" name="numberofp" value=<?php if (isset($_POST['numberofp'])) {
                                                                                                                                echo $_POST['numberofp'];
                                                                                                                            } else echo ''; ?>>
                <br>
                <button class="btn btn-primary" name="submit1">
                    Submit
                </button>
            </div>
            <div class="col-3">
            </div>

            <?php
            if (isset($_POST['submit1'])) {
                $uname = $_POST['name'];
                $city = $_POST['city'];
                $numberofp = $_POST['numberofp'];
                for ($i = 0; $i < $numberofp; $i++) {
                    echo '<div class="col-2">
            </div>
             <div class="col-3">
            <label for="">Prodact Name</label>
            <input type="text" placeholder="Name" class="form-control" name="pname[]">
            </div>
            <div class="col-3">
            <label for="">Quantity</label>
            <input type="text" placeholder="Quantity" class="form-control" name="qnumber[]">
            </div>
            <div class="col-3">
            <label for="">Price</label>
            <input type="text" placeholder="price" class="form-control" name="price[]">
            </div>';
                }
                echo ' <div class="col-2">
        </div>
        <div class="col-3">
        <br>
        <button class="form-control btn btn-primary" name="submit2">
            Calculate
        </button>
        </div>
        </div>
        </form>';
            }


            if (isset($_POST['submit2'])) {
                echo '<div class="container"> <table class="table table-dark">
                              <thead>
                                <tr>
                                 <th scope="col">Product Name</th>
                                 <th scope="col">Price</th>
                                 <th scope="col">Quantity</th>
                                 <th scope="col">Sub Total</th>
                                </tr>
                              </thead>
                              <tbody>';
                $total = 0;
                for ($i = 0; $i < $_POST['numberofp']; $i++) {
                    $sub_total = (int)$_POST['price'][$i] * (int)$_POST['qnumber'][$i];
                    echo  '<tr>
                        <td>' . $_POST['pname'][$i] . '</td>
                        <td>' . $_POST['price'][$i] . ' EPG</td>
                        <td>' . $_POST['qnumber'][$i] . '</td>
                        <td>' . $sub_total . ' EPG</td>
                       </tr>';
                    $total += $sub_total;
                }
                echo ' <tr>
            <th scope="row">Clinte Name</th>
            <td>' . $_POST['name'] . '</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">City</th>
            <td>' . $_POST['city'] . '</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
        <th scope="row">Total</th>
        <td>' . $total . ' EPG</td>
        <td></td>
        <td></td>
    </tr>
    <th scope="row">Discound Value</th>
    <td>';
                if ($total > 1000 && $total < 3000) {
                    $discount =  $total * 0.1;
                    echo $discount;
                } elseif ($total > 3000 && $total < 4500) {
                    $discount =  $total * 0.15;
                    echo $discount;
                } elseif ($total > 4500) {
                    $discount =  $total * 0.2;
                    echo $discount;
                } else {
                    echo 0;
                }
                echo ' EPG</td>
    <td></td>
    <td></td>
</tr>
<tr>
            <th scope="row">Total After Discount</th>
            <td>' . $totalafterdis = $total - $discount . ' EPG</td>
            <td></td>
            <td></td>
        </tr> 
         <tr>
        <th scope="row">Delivary</th>
        <td>';
                switch ($_POST['city']) {
                    case 'Cairo':
                        $delivary = 0;
                        break;
                    case 'Giza':
                        $delivary = 30;
                        break;
                    case 'Alex':
                        $delivary = 50;
                        break;
                    default:
                        $delivary = 100;
                        break;
                }
                $Net_total = 0;
                $Net_total =(int)$totalafterdis + $delivary;
                echo $delivary . ' EPG</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <th scope="row">Net Total</th>
    <td>' . $Net_total . ' EPG</td>
    <td></td>
    <td></td>
</tr>
</tbody>
            </table>
            </div>';
            }


            ?>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>