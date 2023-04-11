<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $result = mysqli_query($conn,"SELECT * FROM bookings");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            if(isset($_POST['submit']) && $_POST['submit']=="insert"){
                if(!empty($_POST['room']) && !empty($_POST['guest']) && !empty($_POST['from']) && !empty($_POST['to'])){
                    $room=$_POST['room'];
                    $room=explode(",",$room);
                    $guest=$_POST['guest'];
                    $from=$_POST['from'];
                    $to=$_POST['to'];
                    if(mysqli_query($conn,"INSERT INTO bookings(gno,hno,rno,dtfr,dtto) VALUES($guest,$room[0],$room[1],'$from','$to')"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO INSERT".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED DETAILS";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
                if(!empty($_POST['booking']) && !empty($_POST['set']) && !empty($_POST['ndate'])){
                    $booking=$_POST['booking'];
                    $set=$_POST['set'];
                    $ndate=$_POST['ndate'];
                    $date=date("Y-m-d");
                    $r=mysqli_query($conn,"SELECT dtfr FROM bookings WHERE bid=$booking");
                    $chkdate=mysqli_fetch_row($r);
                    if($date<$chkdate[0]){
                        if(mysqli_query($conn,"UPDATE bookings SET $set='$ndate' WHERE bid=$booking"))
                            echo "<meta http-equiv='refresh' content='0'>";
                        else
                            echo "FAILED TO UPDATE".mysqli_error($conn);
                    }else
                        echo "Cant Update as the Checkin date has passed!!!";
                }else
                    echo "PLEASE FILL REQUIRED DETAILS";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="delete"){
                if(!empty($_POST['booking'])){
                    $booking=$_POST['booking'];
                    if(mysqli_query($conn,"DELETE FROM bookings WHERE bid=$booking"))  
                    echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO DELETE".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED DETAILS";
            }
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='adminpage.html'">Home</button>
        <h1 align=center><div class=abc>BOOKINGS INFORMATION MODULE</div></h1>
        <form method=POST action=#>
            <table border=2 align=center>
                <tr>
                    <th>Insert</th><th colspan>Update/Delete</th>
                </tr>
                <tr>
                    <td>Select Room : <select name="room">
                        <?php
                            $x=mysqli_query($conn,"SELECT hno,rno FROM rooms");
                            while($xa=mysqli_fetch_row($x)){
                                echo "<option value='$xa[0],$xa[1]'>$xa[0] - $xa[1]</option>";
                            }
                        ?>
                        </select><br>
                        Select Guest : <select name="guest">
                        <?php
                            $x=mysqli_query($conn,"SELECT gno,gname FROM guests");
                            while($xa=mysqli_fetch_row($x)){
                            echo "<option value='$xa[0]'>$xa[0] - $xa[1]</option>";
                            }
                            ?>
                        </select><br>
                        From : <input type="date" name="from">
                        To : <input type="date" name="to">
                    </td>
                    <td>
                        Select Booking : <select name="booking">
                        <?php
                            $x=mysqli_query($conn,"SELECT bid FROM bookings");
                            while($xa=mysqli_fetch_row($x)){
                            echo "<option value='$xa[0]'>$xa[0]</option>";
                            }
                        ?>
                        </select><br>
                        Set: <select name="set">
                            <option value="dtfr">From Date</option>
                            <option value="dtto">To Date</option>
                        </select><br>
                        New Date : <input type="date" name="ndate">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="insert"></td>
                    <td><input type="submit" name="submit" value="update"> <input type="submit" name="submit" value="delete"></td>
                </tr>
            </table>
        </form>
        <table border=2 align=center>
            <tr>
                <th>ID</th><th>G NO</th>
                <th>H NO</th><th>R NO</th>
                <th>FROM</th><th>TO</th>
            </tr>
            <?php
                while($arr=mysqli_fetch_row($result))
                {
                    echo "<tr>
                            <td>$arr[0]</td>
                            <td>$arr[1]</td>
                            <td>$arr[2]</td>
                            <td>$arr[3]</td>
                            <td>$arr[4]</td>
                            <td>$arr[5]</td>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>