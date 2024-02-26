<?php include 'header.php' ?>

<?php 

    require_once 'connection.php';
     $sql = "SELECT * FROM members";

     $run = $conn -> query($sql);
      if($run -> num_rows > 0) {
        $result = $run -> fetch_all(MYSQLI_ASSOC);
      }else {
        $result = false;
        echo "<h1 class='text-center mt-5'>Nema podataka</h1>";
      }   
?>

<div class="container-lg">
    <div class="row">
        <div class="col-2 m-3 d-flex w-100 gap-5  ">
            <button type="button" class="btn btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Dodaj Studenta
            </button>
            <form method="post">
                <input type="submit" class="btn btn-danger" name="restart" value="Obrisi Poruku">
            </form>

            <?php
                if(isset($_POST['restart'])){
                    header('location:index.php');
                }
                if(isset($_GET['message'])){
                    echo "<h3 class='text-danger '>". $_GET['message'] . " </h3>";
                }          
                if(isset($_GET['success'])){
                    echo "<h3 class='text-success  '>". $_GET['success'] . " </h3>";
                }          
            ?>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="add_student.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                            <button type="submit" class="btn btn-primary">Dodaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    <table class='table table-striped '>
        <thead>
            <tr>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>LASTA NAME</th>
                <th>AGE</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if ($result) { 
                    foreach ( $result as $row ){
                        echo '
                            <tr>  
                                <td>'.$row["id"].'</td>
                                <td>'.$row["first_name"].'</td>
                                <td>'.$row["last_name"].'</td>
                                <td>'.$row["age"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["created_at"].'</td>
                                <td>
                                    <a href="update_student.php?id='.$row["id"].'" type="button" class="btn btn-info ">
                                        Update
                                    </a>
                                    <a href="delete_student.php?id='.$row["id"].'" type="button" class="btn btn-danger ">
                                        Delete
                                    </a>
                                </td>
                            </tr>';
                    }
                }
             ?>
        </tbody>
    </table>
</div>



<?php include 'footer.php' ?>