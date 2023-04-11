<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $res = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$res)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));            
            if (empty($_POST['hno']))
                $q="SELECT * FROM rooms;";
            else
            {
                $hno=$_POST['hno'];
                $resname = mysqli_query($conn, "SELECT hname FROM hotel WHERE hno=$hno");
                $hname = mysqli_fetch_row($resname);
                $q = "SELECT * FROM rooms WHERE hno=$hno";
            }
            if (!empty($q))
            {
                $result = mysqli_query($conn, $q);
                if(!$result)
                die("FAILED TO GET ROOM DATA<br>" . mysqli_error($conn));
            }
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='index.php'">Home</button>
        <h1 align=center>UNITS INFORMATION MODULE</h1>
        <form method=POST action="#">
            Select Hotel:
            <select name="hno" style="width:300px;"><option value="">ALL</option></tr>
                <?php
                    while($hlist=mysqli_fetch_row($res))
                        echo "<option value=$hlist[0]>$hlist[0] || $hlist[1] || $hlist[2]</option>";
                ?>
            </select><input type=submit name=submit value=submit>
        </form>
        <table border=2 align=center>
            <tr><th colspan=4>
                    <?php echo (isset($_POST['hno']))?"$hname[0]" :"All Hotels";?>
                </th></tr>
            <tr><th>Hotel No</th><th>Room No</th>
                <th>Type</th><th>Rate</th></tr>
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