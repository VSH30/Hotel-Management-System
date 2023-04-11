<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $result = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            if(isset($_POST['submit']) && ($_POST['submit']=="insert")){
                if(!empty($_POST['hno']) && !empty($_POST['hname']) && !empty($_POST['hadd']) && !empty($_POST['rooms']) && !empty($_POST['rating'])){
                    $hno=$_POST['hno'];
                    $hname=$_POST['hname'];
                    $hadd=$_POST['hadd'];
                    $rooms=$_POST['rooms'];
                    $rating=$_POST['rating'];
                    if(!mysqli_query($conn, "INSERT INTO hotel VALUES($hno,'$hname','$hadd',$rooms,'$rating')"))
                        echo "FAILED TO INSERT".mysqli_error($conn);
                    else
                        echo "<meta http-equiv='refresh' content='0'>";
                }else{
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
                }
            }elseif(isset($_POST['submit']) && ($_POST['submit']=="update")){
                if(!empty($_POST['hnoo']) && !empty($_POST['col']) && !empty($_POST['val'])){
                    $hnoo=$_POST['hnoo'];
                    $op=$_POST['col'];
                    $val=$_POST['val'];
                    if($op=="hno" || $op=="rooms")
                        $upq="UPDATE hotel SET $op=$val WHERE hno=$hnoo";
                    else
                        $upq="UPDATE hotel SET $op='$val' WHERE hno=$hnoo";
                    if(mysqli_query($conn,$upq))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO UPDATED".mysqli_error($conn);
                }else{
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
                }
            }elseif(isset($_POST['submit']) && ($_POST['submit']=="delete")){
                if(!empty($_POST['hnoo'])){
                    $hnoo=$_POST['hnoo'];
                    if(mysqli_query($conn,"DELETE FROM hotel WHERE hno=$hnoo"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO DELETE ROW".mysqli_error($conn);
                }else{
                    echo "PLEASE SELECT A HNO TO DELETE!!!";
                }
            }
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='adminpage.html'">Home</button>
        <h1 align=center><div class=abc>ACCOMODATION INFORMATION MODULE</div></h1>
        <form method="POST" action="#">
        <table border=2 align=center>
            <tr>
                <th>Insert</th>
                <th>Update/Delete</th>
            </tr>
            <tr>
                <td>
                    Hotel No : <input type="text" name="hno"><br>
                </td>
                <td>
                    Hotel No : <select name="hnoo">
                    <?php
                        $hnos=mysqli_query($conn,"SELECT hno FROM hotel");
                        if (!$hnos)
                            die("FAILED TO GET HOTEL NOs" . mysqli_error($conn));
                            while($harr=mysqli_fetch_row($hnos))
                                echo "<option value='$harr[0]'>$harr[0]</option>";
                    ?>
                    </select>
                </td>
            </tr><tr>
                <td>
                    Hotel Name: <input type="text" name="hname"><br>
                    Hotel Address : <input type="text" name="hadd"><br>
                    Rooms : <input type="number" name="rooms"><br>
                    Rating : <input type="text" name="rating"><br>
                </td>
                <td>
                    Set:<select name="col">
                        <option value="hno">Hotel No</option>
                        <option value="hname">Hotel Name</option>
                        <option value="hadd">Hotel Address</option>
                        <option value="rooms">Rooms</option>
                        <option value="rating">Rating</option>
                    </select><br>
                    New Value : <input type="text" name="val">
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
                <th>Hotel No</th>
                <th>Hotel Name</th>
                <th>Hotel Address</th>
                <th>Rooms</th>
                <th>Rating</th>
            </tr>
            <?php
                while($arr=mysqli_fetch_row($result))
                {
                    echo "<tr>
                        <td>$arr[0]</td>
                        <td>$arr[1]</td>
                        <td>$arr[2]</td>
                        <td>$arr[3]</td>
                        <td>$arr[4]</td></td></tr>";
                }
            ?>
        </table>
    </body>
</html>