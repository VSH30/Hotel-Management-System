<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            if (!$conn)
                die("FAILED TO CONNECT<br>" . mysqli_connect_error());
            $res = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$res)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            if (empty($_POST['selhno']))
                $q="SELECT * FROM rooms;";
            else{
                $selhno=$_POST['selhno'];
                $resname = mysqli_query($conn, "SELECT hname FROM hotel WHERE hno=$selhno");
                $hname = mysqli_fetch_row($resname);
                $q = "SELECT * FROM rooms WHERE hno=$selhno";
            }
            if (!empty($q)){
                $result = mysqli_query($conn, $q);
                if(!$result)
                die("FAILED TO GET ROOM DATA<br>" . mysqli_error($conn));
            }
            $table = "rooms";
            if(isset($_POST['submit']) && $_POST['submit']=="insert"){
                if(!empty($_POST['num']) && !empty($_POST['rmno']) && !empty($_POST['tp']) && !empty($_POST['rate'])){
                    $num=$_POST['num'];
                    $rmno=$_POST['rmno'];
                    $tp=$_POST['tp'];
                    $rate=$_POST['rate'];
                    if(mysqli_query($conn,"INSERT INTO rooms VALUES($num,$rmno,'$tp',$rate)"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO INSERT".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="update")
                if(!empty($_POST['rno']) && !empty($_POST['col']) && !empty($_POST['val'])){
                    $abc=$_POST['rno'];
                    $abc=explode(",",$abc);
                    $h=$abc[0];$r=$abc[1];
                    $col=$_POST['col'];
                    $val=$_POST['val'];
                    if($col=="rate")
                        $upq="UPDATE rooms SET $col=$val WHERE hno=$h AND rno=$r";
                    else
                        $upq="UPDATE rooms SET $col='$val' WHERE hno=$h AND rno=$r";
                    if(mysqli_query($conn,$upq))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO Update".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
            elseif(isset($_POST['submit']) && $_POST['submit']=="delete")
                if(!empty($_POST['rno'])){
                    $abc=$_POST['rno'];
                    $abc=explode(",",$abc);
                    $h=$abc[0];$r=$abc[1];
                    if(mysqli_query($conn,"DELETE FROM rooms WHERE hno=$h AND rno=$r"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO Delete".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
        ?>
    </head>
    <body>
        <button onclick="window.location.href='adminpage.html'">Home</button>
        <h1 align=center>UNITS INFORMATION MODULE</h1>
        <form method=POST action="#">Select Hotel:
            <select name="selhno" style="width:300px;">
                <option value="">ALL</option></tr>
                <?php
                    while($hlist=mysqli_fetch_row($res))
                        echo "<option value=$hlist[0]>$hlist[0] || $hlist[1] || $hlist[2]</option>";
                ?>
            </select><input type=submit name=SHOW value=SHOW>
        <table border=2 align=center>
            <tr><th>Insert</th><th colspan=2>Update/Delete</th></tr>
            <tr><td>Enter Hno : <input type="number" name="num"><br>
                    Enter Rno : <input type="number" name="rmno"><br>
                    Enter Type : <select name="tp">
                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
                        <option value="Family">Family</option>
                        <option value="Presidential Suite">Presidential Suite</option>
                    </select><br>
                    Rate : <input type="number" name="rate">
            </td>
            <td colspan=2>Select Room : <select name="rno">
                <?php
                    $rr = mysqli_query($conn, "SELECT * FROM rooms");
                    if (!$rr)
                        die("FAILED TO GET ROOMS DATA" . mysqli_error($conn));
                    while($v=mysqli_fetch_row($rr))
                        echo "<option value='$v[0],$v[1]'>$v[0] || $v[1] || $v[2] || $v[3]</option>";
                ?>
                </select><br><br>Set : <select name="col">
                        <option value="rtype">Room type</option>
                        <option value="rate">Rate</option>
                </select><br>
                    New Value : <input type="text" name="val">
            </td></tr>
            <tr><td><input type="submit" name="submit" value="insert"></td>
                <td><input type="submit" name="submit" value="update"></td>
                <td><input type="submit" name="submit" value="delete"></td></tr>
        </table>
        </form>
        <table border=2 align=center>
            <tr><th colspan=4>
                    <?php echo (isset($_POST['hno']))?"$hname[0]" :"All Hotels";?>
                </th> </tr>
            <tr><th>Hotel No</th><th>Room No</th><th>Type</th><th>Rate</th></tr>
            <?php
                while($arr=mysqli_fetch_row($result))
                {
                    echo "<tr>
                            <td>$arr[0]</td>
                            <td>$arr[1]</td>
                            <td>$arr[2]</td>
                            <td>$arr[3]</td>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>