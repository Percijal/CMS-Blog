<?php
try {
    $conn = new PDO('sqlite:database\mydb.db');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// $ready = (isset($_POST["login"])) ? true : false;


$ready = (isset($_POST["entryTitle"])) ? true : false;

if($ready){
    $title = $_POST["entryTitle"];
    $date = date("d-m-Y");
    $text = $_POST["entryText"];
    $author = $_POST["entryAuthor"];

    $sql = "INSERT INTO wpis(title, date, mainText, author) VALUES('$title', '$date', '$text', '$author');";
    $query = $conn->prepare($sql);
    $query->execute();
    foreach ($_POST as $k=>$v) {
        unset($_POST[$k]);
    }
    header("Location: ../CMS/index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateEntry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="../CMS/style/style.css">
</head>
<body>
    
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
            <h2><a href="index.php"><-Back-</a></h2>
        </div>
    </div>

    <div class="container">
        <!-- <div class="row">
            <div class="d-flex col-2 align-items-end items-end justify-content-end" style="padding: 0px;">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <div class="slider round"></div>
                    </label>
                    <em>Enable Dark Mode!</em>
                </div>
            </div>
            <div class="d-flex col-8 align-items-center items-center justify-content-center" style="padding: 0px;">
                <h2>Create Your Own Entry</h2>
            </div>
            <div class="d-flex col-2 align-items-start items-start justify-content-start" style="padding: 0px;">
                <h2><a href="index.php"><-Back-</a></h2>
            </div>
        </div> -->
        <br>
        <div class="row">
            <div class="d-flex col align-items-center items-center justify-content-center">
                <q>Let rest know about your thougths</q>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="d-flex col align-items-center items-center justify-content-center">
                <fieldset>
                    <legend style="text-align: center; font-style: italic; font-weight: bold;">Create</legend>
                    <form method="POST">
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <label>Title: </label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="entryTitle" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <label>Text of your entry: </label>
                            </div>
                            <div class="col-6">
                                <textarea id="w3review" name="entryText" rows="4" cols="50" placeholder="Here leave your text ..." required></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <label>Author Name: </label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="entryAuthor" required>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-sm-center">
                            <div class="col-auto col-sm-auto col-md-auto col-lg-auto">
                                <input class="submitButton" type="submit" value="Create" class="registerButton">
                                <br>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="footer sticky-bottom bg-gray opacity-100 w-100"  style="width: 100%;">
        <div class="row">
            <p class="col-3" style="padding-left: 25px;">Copyright ©️ 2022</p>
            <p class="col-3">...</p>
            <p class="col-3 offset-1">Tel: +48 123 456 789</p>
            <div class="col-2">
                <a class="float-end" href="#" style="padding-right: 15px; background-color: transparent; text-decoration: none;" disabled><u>Contact</u></a>
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