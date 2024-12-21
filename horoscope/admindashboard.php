<?php
// Create database connection using config file
include_once("config.php");

function convertNumtoMonth($month){
    switch($month){
        case 1:
            $month="January";
            break;
        case 2:
            $month="February";
            break;
            
        case 3:
            $month="March";
            break;
        case 4:
            $month="April";
            break;
            
        case 5:
            $month="May";
            break;
        case 6:
            $month="June";
            break;
        
        case 7:
            $month="July";
            break;
        case 8:
            $month="August";
            break;
        case 9:
            $month="September";
            break;
        case 10:
            $month="October";
            break;
        case 11:
            $month="November";
            break;
        case 12:
            $month="December";
            break;
        default:
            $month="N/A";
            break;
    }
    return $month;
}         

// Fetch all users data from database
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
$zodiac_result = mysqli_query($conn, "SELECT * FROM zodiac ORDER BY id_zodiac ASC");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administrator Dashboard</title>
        <link rel="stylesheet" href="styles/login.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Administrator Dashboard</h1>
        
        <table width='40%' border=2 class="table">
            <h1>Users</h1>
            <tr>
                <th>Firstname</th> <th>Lastname</th> <th>Username</th> <th>Birthday</th> <th>Gender</th> <th>Operations</th>
            </tr>
            <?php  
                while($user_data = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$user_data['first_name']."</td>";
                    echo "<td>".$user_data['last_name']."</td>";
                    echo "<td>".$user_data['username']."</td>";
                    echo "<td>".convertNumtoMonth($user_data['month'])." ".$user_data['day'].", ".$user_data['year']."</td>";    
                    echo "<td>".ucfirst($user_data['gender'])."</td>";    
                    echo "<td><a href='edit-user.php?id=$user_data[id]'><button class='btn btn-primary'>Edit</button></a> <a href='delete-user.php?id=$user_data[id]'><button class='btn btn-primary'>Delete</button></a></td>";
                }
                echo '';
            ?>
        </table>
        <a href="add-users.php" class="btn btn-primary">Add New User</a>
        <table width='40%' border=2 class="table">
            <h1>Zodiac Signs</h1>
            <tr>
                <th>Zodiac Sign Name</th> <th>Description</th> <th>Daily Horoscope</th> <th>Monthly Horoscope</th> <th>Month Range</th> <th>Image Path</th>
            </tr>
            <?php  
                while($user_data = mysqli_fetch_array($zodiac_result)) {
                    echo "<tr>";
                    echo "<td>".$user_data['sign_name']."</td>";
                    echo "<td>".$user_data['description']."</td>";
                    echo "<td>".$user_data['daily_horoscope']."</td>";
                    echo "<td>".$user_data['monthly_horoscope']."</td>";
                    echo "<td>".convertNumtoMonth($user_data['month_min'])." ".$user_data['day_min']." - ".convertNumtoMonth($user_data['month_max'])." ".$user_data['day_max']."</td>";    
                    echo "<td>".$user_data['image_path']."</td>";    
                    echo "<td><a href='edit-zodiac.php?id=$user_data[id_zodiac]'><button class='btn btn-primary'>Edit</button></a> <a href='delete-zodiac.php?id=$user_data[id_zodiac]'><button class='btn btn-primary'>Delete</button></a></td>";
                }
            ?>
        </table>
        <a href="add-zodiac.php" class="btn btn-primary">Add New Zodiac</a><br><br>
        <a href="logout.php" class="btn btn-primary">Log out</a>
    </body>
</html>