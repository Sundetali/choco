
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AviaAgent</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mx-auto d-flex flex-column justify-content-center">
                    <header class="mb-4">
                        <img src="img/logo.png" alt="choco logo" class="d-block mx-auto">
                    </header>
                    <form role="tabpanel" class="tab-pane fade in active show d-flex flex-column" id="signin" method="POST" action="signin.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="username form-control" id="username"  name='username' >
                            <span class="valid"></span>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль:</label>
                            <input type="password" class="password form-control" id="password" name='password' >
                            <span class="valid"></span>
                            <span></span>
                        </div>
                        <button type="submit" class="btn btn-red btn-valid btn-orange" name="signin">ВОЙТИ</button>
                    </form>      
                </div>
            </div>
        </div>
    </div>
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	
</body>
</html>