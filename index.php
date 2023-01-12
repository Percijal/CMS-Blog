<?php
try {
    $conn = new PDO('sqlite:database\mydb.db');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM wpis ORDER BY id DESC;";
$query = $conn -> query($sql);
$rows = $query -> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <!-- <h1>Test</h1> -->
    <div class="row header sticky-top opacity-100 w-100">
        <div class="d-flex col-2 align-items-center items-center justify-content-center ">
            <div class="theme-switch-wrapper">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <div class="slider round"></div>
                </label>
                <em>= Dark Mode =</em>
            </div>
        </div>
        <div class="d-flex col-8 align-items-center items-center justify-content-center" style="padding: 0px;">
            <h2><q>Simple Blog</q></h2>
        </div>
        <div class="d-flex col-2 align-items-center items-center justify-content-center" style="padding: 0px;">
            <h2><a href="addEntry.php">+Add</a></h2>
        </div>
    </div>

    <div class="container align-items-center items-center justify-content-center">
        <br>
        <!-- <div class="row">
            <div class="d-flex col align-items-center items-center justify-content-center">
                Simple blog explanation
            </div>
        </div> -->
        <br>
        <div class="row">

            <?php
                foreach ($rows as $row) {
                    echo'<div class="col-11 mainEntry" >
                            <h4 style="padding-top: 8px;">'.$row["title"].'</h4>
                            Data wpisu: '.$row["date"].'<br>
                            <hr>
                            '.$row["mainText"].'<br>
                            <hr>
                            Written by: '.$row["author"].'<br><br>
                        </div>
                        <div class="col-1 mainFunctions">
                            <div class="w-100">
                                <a href="editEntry.php?id='.$row['id'].'">edit</a>
                                <hr>
                                <a href="deleteEntry.php?id='.$row['id'].'">delete</a>
                            </div>
                        </div>
                    ';
                }
            ?>

        </div>
        <!-- <div class="row">
            <div class="d-flex footer col align-items-center items-center justify-content-center">
                Simple footer
            </div>
        </div> -->

    </div>
    <div class="footer sticky-bottom bg-gray opacity-100 w-100"  style="width: 100%;">
        <div class="row">
            <p class="col-3" style="padding-left: 25px;">Copyright ©️ 2022</p>
            <p class="col-3">...</p>
            <p class="col-3 offset-1">Tel: +48 123 456 789</p>
            <div class="col-2">
                <a class="float-end" href="#" style="padding-right: 15px; background-color: transparent; text-decoration: none; "disabled><u>Contact</u></a>
            </div>
        </div>
    </div>
    
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark'); //add this
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light'); //add this
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);

const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

</script>