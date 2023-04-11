<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $result = mysqli_query($conn,"SELECT * FROM fac");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='index.php'">Home</button>
        <h1 align=center>FACILITY INFORMATION MODULE</h1>
        <table border=2 align=center>
            <tr><th>Facility No</th><th>Facility Name</th></tr>
            <?php
                while($arr=mysqli_fetch_row($result)){
                    echo "<tr>
                            <td>$arr[0]</td>
                            <td>$arr[1]</td>
                        </tr>";
                }
            ?>
        </table>
    </body>
</html>