<html>
    <head>
        <?php
            include('../dbconn.php');
            $conn = dbconn();
            if (!$conn)
                die("FAILED TO CONNECT<br>" . mysqli_connect_error());

            $result = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));

            //OPERATIONS
            if(isset($_POST['submit']) && ($_POST['submit']=="insert")){
                if(!empty($_POST['hno']) && !empty($_POST['hname']) && !empty($_POST['hadd']) && !empty($_POST['rooms']) && !empty($_POST['rating']) && !empty($_POST['hfac'])){
                    $hno=$_POST['hno'];
                    $hname=$_POST['hname'];
                    $hadd=$_POST['hadd'];
                    $rooms=$_POST['rooms'];
                    $rating=$_POST['rating'];
                    $hfac=$_POST['hfac'];

                    if(!mysqli_query($conn, "INSERT INTO hotel VALUES($hno,'$hname','$hadd',$rooms,'$rating','$hfac')"))
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
                    if($op=="hno" || $op=="rooms"){
                        $upq="UPDATE hotel SET $op=$val WHERE hno=$hno";
                    }else{
                        $upq="UPDATE hotel SET $op='$val' WHERE hno=$hno";
                    }
                    if(mysqli_query($conn,$upq)){
                        echo "<meta http-equiv='refresh' content='0'>";
                    }else{
                        echo "FAILED TO UPDATED".mysqli_error($conn);
                    }
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

        <style>
            tr,td,th{
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <h1 align=center>ACCOMODATION INFORMATION MODULE</h1>
        <form method="POST" action="#">
        <table border=2 align=center>
            <tr>
                <th>Insert</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>
                    Hotel No : <input type="text" name="hno"><br>
                </td>
                <td colspan=2>
                    Hotel No : <select name="hnoo">
                                    
                                    <?php
                                        $hnos=mysqli_query($conn,"SELECT hno FROM hotel");
                                    if (!$hnos)
                                        die("FAILED TO GET HOTEL NOs" . mysqli_error($conn));
                                    //echo "<option value='' selected></option>";
                                    while($harr=mysqli_fetch_row($hnos))
                                        echo "<option value='$harr[0]'>$harr[0]</option>";
                                    ?>
                        </select>
                </td>
            </tr>
                <td>
                    Hotel Name: <input type="text" name="hname"><br>
                    Hotel Address : <input type="text" name="hadd"><br>
                    Rooms : <input type="number" name="rooms"><br>
                    Rating : <input type="text" name="rating"><br>
                    Facilities : <input type="text" name="hfac"><br>
                </td>
                <td>
                    Set : <select name="col">
                            <option value="hno">Hotel No</option>
                            <option value="hname">Hotel Name</option>
                            <option value="hadd"></option>
                            <option value="rooms">Rooms</option>
                            <option value="rating">Rating</option>
                            <option value="hfac">Facilities</option>
                        </select><br>
                    New Value : <input type="text" name="val">
                </td>
                <td>
                    -
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="insert"></td>
                <td><input type="submit" name="submit" value="update"></td>
                <td><input type="submit" name="submit" value="delete"></td>
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
                <th>Facilities</th>
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