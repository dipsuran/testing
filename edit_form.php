<?php include "config.php"; 

$id = $_GET['id'];

$sql = "SELECT p.id AS id,p.Country AS Country,c.city_name AS City,
s.state_name AS State,p.name AS name ,
p.phone AS phone, p.gender AS gender,p.State AS State_id, p.City AS City_id 
FROM personal_details p 
JOIN states s ON s.id = p.State
JOIN cities c ON c.id = p.City  
WHERE p.id = 12;";


$result = $conn->query($sql);
$editData = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #personal_editData{
            display: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Edite  Form</h1>
    <form  method="POST" id="dependent_editData">
        <div class="form-group">
            <!-- <label for="id">ID:</label> -->
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $editData['id'];?>">
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <select class="form-control" id="country" name="country" required>
            <?php 
                $sql = "SELECT * FROM countries";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<option value="">Select a country</option>';
                    while($row = $result->fetch_assoc()) {
                        $selected =  $editData['Country'] == $row['id'] ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" '.$selected.'>' . htmlspecialchars($row['name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No countries available</option>';
                }
            ?>
            </select>

        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <select class="form-control" id="state" name="state" required>
                <option value="<?php echo $editData['State_id'];?>"><?php echo $editData['State'];?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="city" name="city" required>
                <option value="<?php echo $editData['City_id'];?>"><?php echo $editData['City'];?></option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Next</button>
    </form>

    <form id="personal_editData" method="POST">  
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $editData['name'];?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $editData['phone'];?>" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo $editData['gender'] == 'male' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo $editData['gender'] == 'female' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" <?php echo $editData['gender'] == 'other' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="asset/js/custom.js"></script>

</body>
</html>
