<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $result = mysqli_query($conn,"SELECT * FROM fac");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            if(isset($_POST['submit']) && $_POST['submit']=="insert"){
                if(!empty($_POST['fno']) && !empty($_POST['fname'])){
                    $fno=$_POST['fno'];
                    $fname = $_POST['fname'];
                    $insr = mysqli_query($conn,"INSERT INTO fac VALUES($fno,'$fname')");
                    if (!$insr)
                        echo "FAILED TO INSERT" . mysqli_error($conn);
                    else
                        echo "<meta http-equiv='refresh' content='0'>";
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
                if(!empty($_POST['facid']) && !empty($_POST['facname'])){
                    $facid = $_POST['facid'];
                    $facname = $_POST['facname'];
                    $upr = mysqli_query($conn, "UPDATE fac SET facname='$facname' WHERE facid=$facid");
                    if(!$upr)
                        echo "FAILED TO UPDATE" . mysqli_error($conn);
                    else
                        echo "<meta http-equiv='refresh' content='0'>";
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="delete"){
                if(!empty($_POST['facid'])){
                    $facid = $_POST['facid'];
                    $qqq = "DELETE FROM fac WHERE facid=$facid;";
                    $qqq .= "DELETE FROM hotfac WHERE facid=$facid;";
                    $delr = mysqli_multi_query($conn, $qqq);
                    if (!$delr)
                        echo "FAILED TO DELETE" . mysqli_error($conn);
                    else
                        echo "<meta http-equiv='refresh' content='0'>";
                    }else
                        echo "PLEASE FILL REQUIRED FIELDS!!!";
            }
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='adminpage.html'">Home</button>
        <h1 align=center>FACILITY INFORMATION MODULE</h1>
        <form method=POST action=#>
            <table align=center border=2>
                <tr><th>Insert</th><th colspan=2>Update/Delete</th></tr>
                <tr><td>
                    Enter Fac id : <input type=number name=fno><br>
                    Enter Fac Name : <input type="text" name=fname>
                </td>
                <td colspan=2>
                    Select Fac id : <select name=facid>
                    <?php
                        $fff = mysqli_query($conn,"SELECT * FROM fac");
                        if (!$fff)
                            echo "FAILED TO GET FAC DATA" . mysqli_error($conn);
                        while($frs=mysqli_fetch_row($fff))
                            echo "<option value=$frs[0]>$frs[0]</option>";
                    ?>
                    </select><br>
                    SET Fac Name : <input type="text" name="facname">
                </td></tr>
                <tr>
                    <td><input type="submit" name="submit" value="insert"></td>
                    <td colspant=2><input type="submit" name="submit" value="update"> <input type="submit" name="submit" value="delete"></td>
                </tr>
            </table>
        </form>
        <table border=2 align=center>
            <tr>
                <th>Facility No</th><th>Facility Name</th>
            </tr>
            <?php
                while($arr=mysqli_fetch_row($result))
                {
                    echo "<tr>
                            <td>$arr[0]</td>
                            <td>$arr[1]</td>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>