<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php 
            if(isset($_SESSION['add'])){ //checking whether session is set or not
                echo $_SESSION['add'];   //Display the session message
                unset ($_SESSION['add']); //remove  session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your UserName">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>

</div>

<?php include("partials/footer.php") ?>

<?php

    //Process the value from Form and Save it to the Database
    //Check whether the submit button is clicked or not

    if (isset($_POST['submit'])) {
        //echo "button Clicked";

        //1. Get the data from here
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted with md5

        //2. sql querey to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";
      
        //3. executing querey and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (querey is excuted) data is inserted or not and display the message.
        if ($res = true) {
            //Data inserted
            //echo "Data inserted";
            // created a session variable to Display method
            $_SESSION['add'] = 'Admin Added Successfully';
            //Rrdirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to data insert
            //echo "Failed to insert data";
            // created a session variable to Display method
            $_SESSION['add'] = 'Failed to Add Admin';
            //Rrdirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    

?>