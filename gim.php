<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            if (!$conn)
                die("FAILED TO CONNECT<br>" . mysqli_connect_error());
            $result = mysqli_query($conn,"SELECT * FROM guests");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='index.php'">Home</button>
        <h1 align=center>GUESTS INFORMATION MODULE</h1>
        <table border=2 align=center>
            <tr><th>Guest No</th><th>Guest Name</th>
                <th>Guest Address</th><th>Guest Contact</th></tr>
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