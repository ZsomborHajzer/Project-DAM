<?php
    @ob_start();
    session_start();
    $pageName = "E3T-Talents";
    $cssFile = "logInPage.css";
    include "/var/www/E3T/components/header.php";
?>




    <body>

    <div class="loginForm">
         <form action="logInPage.php" method="post">
            <h1>Login</h1>
            <div class="content">
                <div class="inputField">
                    <label for="inputField1">Email</label>
                    <input id="inputField1" name="dataMail" type="email" required >
                </div>
                <div class="inputField">
                    <label for="inputField2">Password</label>

                    <input id="inputField2" name="dataPassword" type="password" required >
                </div>
                <div class="action">
                    <button>Login</button>
                </div>
            </div>

        </form>
    </div>

    </body>
</html>
<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = [];

    if (empty($_POST["dataMail"])) {
        $err[] = "Mail is missing";
    }
    if (empty($_POST["dataPassword"])) {
        $err[] = "Password is missing";
    }


    if (empty($err)) {

        if ($mail = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL)) {


            $dsn = "mysql:host=localhost;dbname=E3T";
            $user = "root";
            $passwd = "!User_12";

            //Connecting to a database
            $dbHandler = new PDO($dsn, $user, $passwd);

            //$mail = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL);
            $userPw = $_POST["dataPassword"];

            $stmt = $dbHandler->prepare("SELECT * FROM tblUser WHERE  `dtEmail` = ?");

            $stmt->execute([$mail]);
            $dbPassWd= "";

            while ($row = $stmt->fetch()) {
                $dbPassWd = $row["dtPassword"];
              //  $id = $row["idUser"];
                $_SESSION["isAdmin"]=$row["dtIsAdmin"];
                //saves the id and email in session.
                $_SESSION["userEmail"]=$row["dtEmail"];
                $_SESSION["id"] = $row["idUser"];
            }

            if ($userPw==$dbPassWd){
                echo  '<script>alert("You are logged in")</script>';

               // header("Location: index.php?page=Add");
            }else{
                echo  '<script>alert("Not loged in")</script>';
            }


        } else {
            echo '<script>alert("Invalid email")</script>';
        }

    } else {
        echo "<ul>";
        foreach ($err as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}else {


}
ob_flush();




include "/var/www/E3T/components/footer.html";


?>