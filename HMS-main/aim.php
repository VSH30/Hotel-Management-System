<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();

            $result = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='index.php'">Home</button>
        <h1 align=center>ACCOMODATION INFORMATION MODULE</h1>
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
                            <td>$arr[4]</td><td>";
                    $hhnnoo=$arr[0];
                    $facres=mysqli_query($conn,"SELECT facname FROM hotfac,fac,hotel WHERE hotfac.hno=hotel.hno AND hotfac.facid=fac.facid AND hotfac.hno=$hhnnoo;");
                    while($xyz=mysqli_fetch_row($facres)){
                    echo " [$xyz[0]] ";
                    }
                    echo "</td></tr>";
                }
            ?>
        </table>
    </body>
</html>