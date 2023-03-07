<html>
    <head>
        <?php
            include('dbconn.php');
            $conn = dbconn();
            if (!$conn)
                die("FAILED TO CONNECT<br>" . mysqli_connect_error());

            $result = mysqli_query($conn,"SELECT * FROM hotel");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
        ?>

        <style>
            tr,td,th{
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>
    <body>
    <a href="index.html">Return/Back</a>
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
                            <td>$arr[4]</td>
                            <td>$arr[5]</td>
                        </tr>";
                }
            ?>
        </table>
        <a href="index.html">Return/Back</a>
    </body>
</html>