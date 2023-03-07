<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            if (!$conn)
                die("FAILED TO CONNECT<br>" . mysqli_connect_error());
            $result = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            if(isset($_POST['submit']) && $_POST['submit']=="insert"){
                if(!empty($_POST['hno']) && !empty($_POST['fac'])){
                    $hhh = $_POST['hno'];
                    $fff = $_POST['fac'];
                    if(mysqli_query($conn,"INSERT INTO hotfac VALUES($hhh,$fff)"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO INSERT".mysqli_error($conn);
                }else
                    echo "PLEASE FILL REQUIRED DETAILS";
            }elseif(isset($_POST['submit']) && $_POST['submit']=="delete"){
                if(!empty($_POST['del'])){
                    $del = $_POST['del'];
                    $del = explode(",", $del);
                    if (mysqli_query($conn, "DELETE FROM hotfac WHERE hno=$del[0] AND facid=$del[1]"))
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
        <h1 align=center>HOTEL FACILITY INFORMATION MODULE</h1>
        <form method=POST action=#>
            <table border=2 align=center>
                <tr><th>Insert</th><th>Delete</th></tr>
                <tr><td>Select Hotel : <select name="hno">
                    <?php
                        $hr = mysqli_query($conn, "SELECT hno,hname FROM hotel");
                        if (!$hr)
                            echo "FAILED TO GET DATA" . mysqli_error($conn);
                        while($ha=mysqli_fetch_row($hr))
                            echo "<option value=$ha[0]>$ha[1]</option>";
                    ?>
                    </select>
                    Select Facility : <select name="fac">
                    <?php
                        $fr = mysqli_query($conn, "SELECT facid,facname FROM fac");
                        if (!$fr)
                            echo "FAILED TO GET DATA" . mysqli_error($conn);
                        while($fa=mysqli_fetch_row($fr))
                            echo "<option value=$fa[0]>$fa[1]</option>";
                    ?>
                    </select></td>
                    <td>Select Hot-Fac : <select name="del">
                    <?php
                        $delq = mysqli_query($conn, "SELECT * FROM hotfac,fac WHERE hotfac.facid=fac.facid");
                        if (!$delq)
                            echo "FAILED TO GET DATA" . mysqli_error($conn);
                        while($df=mysqli_fetch_row($delq))
                            echo "<option value='$df[0],$df[1]'>$df[0] - $df[3]</option>";
                    ?>
                    </select></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="insert"></td>
                    <td><input type="submit" name="submit" value="delete"></td>
                </tr>
            </table>
        </form>
        <table border=2 align=center>
            <tr><th>Hotel No</th><th>Hotel Name</th><th>Facilities</th></tr>
            <?php
                while($arr=mysqli_fetch_row($result))
                {
                    echo "<tr>
                            <td>$arr[0]</td>
                            <td>$arr[1]</td><td>";
                    $hhnnoo=$arr[0];
                    $facres=mysqli_query($conn,"SELECT facname FROM hotfac,fac,hotel WHERE hotfac.hno=hotel.hno AND hotfac.facid=fac.facid AND hotfac.hno=$hhnnoo;");
                    while($xyz=mysqli_fetch_row($facres))
                        echo " [$xyz[0]] ";
                    echo "</td></tr>";
                }
            ?>
        </table>
    </body>
</html>