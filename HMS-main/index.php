<html>
    <head>
        <title>User Home</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1 align="center">HOTEL MANAGEMENT SYSTEM</h1>
        <table align=right>

            <form method=POST action=#>
                <tr><td>Admin ID</td><td>Enter Password</td>
                <td><input type="reset" name="reset" value="Reset"></td></tr>
                <tr><td><input type="text" name="userid"></td><td><input type="text" name="pass"></td>
                <td><input type="submit" name="submit" value="Login"></td></tr>
            </form>
        </table>
        <br>
        <?php
            if(isset($_POST['submit'])){
                include('functions.php');
                $conn = dbconn();
                $u = $_POST['userid'];
                $p = $_POST['pass'];
                $select = mysqli_query($conn, "SELECT pass FROM users WHERE userid='$u'");
                if(!$select){
                    echo "WRONG USER ID!!!".mysqli_error($conn);
                }else{
                    $pass = mysqli_fetch_row($select);
                    if($pass[0] == $p){
                        session_start();
                        $_SESSION['user'] = $u;
                        header('Location:adminpage.html');
                    }else{
                        echo "WRONG PASSWORD ENTERED!!!";
                    }
                }
            }
        ?>
        <style>
            .ab{
                text-align: center;
                padding: 10px;
            }
        </style>
        
        <br><br><br><br><br>
        
        <table border="2" align="center" width=80%>
            <tr class="ab">
                <td class="ab"><a href="aim.php">Accomodation Information Module</a></td>
                <td class="ab"><a href="uim.php">Units Information Module</a></td>
            </tr>
            <tr class="ab">
                <td  class="ab" colspan="2"><a href="bim.php">Bookings Information Module</a></td>
            </tr>
            <tr class="ab">
                <td class="ab"><a href="gim.php">Guests Information Module</a></td>
                <td class="ab"><a href="fim.php">Facility Information Module</a></td>
            </tr>
        </table>
    </body>
</html>