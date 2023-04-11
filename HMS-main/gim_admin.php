<html>
    <head>
        <?php
            include('functions.php');
            $conn = dbconn();
            $result = mysqli_query($conn,"SELECT * FROM guests");
            if (!$result)
                die("FAILED TO GET DATA<br>" . mysqli_error($conn));
            $table="guests";
            if(isset($_POST['submit']) && ($_POST['submit']=="insert")){
                if(!empty($_POST['name']) && !empty($_POST['add']) && !empty($_POST['mob'])){
                    $name = $_POST['name'];
                    $add = $_POST['add'];
                    $mob = $_POST['mob'];
                    if(!mysqli_query($conn, "INSERT INTO guests(gname,gadd,gmob) VALUES('$name','$add',$mob)"))
                        echo "FAILED TO INSERT".mysqli_error($conn);
                    else
                        echo "<meta http-equiv='refresh' content='0'>";
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";            
            }elseif(isset($_POST['submit']) && ($_POST['submit']=="update")){
                if(!empty($_POST['gno']) && !empty($_POST['col']) && !empty($_POST['val'])){
                    $gno=$_POST['gno'];
                    $op=$_POST['col'];
                    $val=$_POST['val'];
                    if($op=="gmob")
                        $upq="UPDATE guests SET $op=$val WHERE gno=$gno";
                    else
                        $upq="UPDATE guests SET $op='$val' WHERE gno=$gno";
                    if(mysqli_query($conn,$upq))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO UPDATED".mysqli_error($conn);
                    
                }else
                    echo "PLEASE FILL REQUIRED FIELDS!!!";
            }elseif(isset($_POST['submit']) && ($_POST['submit']=="delete")){
                if(!empty($_POST['gno'])){
                    $gno=$_POST['gno'];
                    if(mysqli_query($conn,"DELETE FROM guests WHERE gno=$gno"))
                        echo "<meta http-equiv='refresh' content='0'>";
                    else
                        echo "FAILED TO DELETE ROW".mysqli_error($conn);
                }else
                    echo "PLEASE SELECT A HNO TO DELETE!!!";
            }
        ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <button onclick="window.location.href='adminpage.html'">Home</button>
        <h1 align=center>GUESTS INFORMATION MODULE</h1>
            <form method=POST action=#>
                <table border=2 align=center>
                    <tr><td>Insert</td><td colspan=2>Update/Delete</td></tr>
                    <tr><td>
                            Enter Name : <input type="text" name="name"><br>
                            Enter Address : <input type="text" name="add"><br>
                            Enter Contact : <input type="number" name="mob" size=10><br>
                    </td>
                    <td colspan=2>
                        Select Guest : <select name="gno" style="width:300px;">
                        <option value="" selected></option>
                        <?php
                            $gr = mysqli_query($conn,"SELECT * FROM guests");
                                if (!$gr)
                                    die("FAILED TO GET GUEST DATA!!!" . mysqli_error($conn));
                                while($v=mysqli_fetch_row($gr))
                                    echo "<option value=$v[0]>$v[0] || $v[1] || $v[2]</option>";
                        ?>
                        </select><br><br>
                        Set : <select name="col">
                            <option value="gname">Name</option>
                            <option value="gadd">Address</option>
                            <option value="gmob">Mobile</option>
                        </select><br>
                        New Value : <input type="text" name="val">
                    </td></tr>
                    <tr><td><input type="submit" name="submit" value="insert"></td>
                        <td><input type="submit" name="submit" value="update"></td>
                        <td><input type="submit" name="submit" value="delete"></td></tr>
                </table>
            </form>
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