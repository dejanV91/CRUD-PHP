<?php 
    require_once 'connection.php';

    $id = $_GET['id'];   
    $sql = "SELECT * FROM members WHERE id = $id";

    $result = $conn -> query($sql);
    
    if ($result -> num_rows == 0) {
        header("location:index.php?message=Nema Studenta sa tim idem");
    }
        
    $row = $result -> fetch_assoc();
?>

<?php
    if (isset($_POST["update_student"])) {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        
        $sql = "UPDATE members SET first_name=?, last_name=?, age=?, email=? WHERE id=?";
        $run = $conn -> prepare($sql);
        $run -> bind_param("sssss", $fname, $lname, $age, $email, $_GET['id']);

        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($age)) {
            $run -> execute();
            header("location:index.php?success=Student je uspesno izmenjen!");
        }else {
            header("location:index.php?message=Sva polja moraju biti popunjena!");
        }
    }
?>


<?php include('header.php') ?>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="update_student.php?id=<?php echo $id?>" method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value=<?php echo $row['first_name'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value=<?php echo $row['last_name'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value=<?php echo $row['age'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value=<?php echo $row['email'] ?>>
                    </div>
                    <input type="submit" class='btn btn-primary' name="update_student" value="Update">
                    <a href="index.php" type="button" class='btn btn-light'>Cancel</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>