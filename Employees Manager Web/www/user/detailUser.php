<?php
	//check neu ko phai admin thi chuyen ve page index
	session_start();
	require_once('../function.php');
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    }else{
        $user = $_SESSION['user'];

        $sql = "SELECT * FROM account WHERE username=?";
		$conn = connect_db();
        $stm = $conn->prepare($sql);
        $stm->bind_param("s", $user); 
            
            
		if (!$stm->execute()){
			die('can not execute: ' . $stm->error);
		}
        $result = $stm->get_result();
        $data = $result->fetch_assoc();
        if(password_verify($user, $data['password']) == true){
            header('Location: ../changepass.php');
            exit();
        }
    }
	$sql = "SELECT * FROM account where username = ?";
    $conn = connect_db();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user']);  

	if (!$stmt->execute()) {
		return array(
			'code' => 2,
			'message' => 'An error occured: ' . $stmt->error,
		);
	}
	$result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $_SESSION['role'] = $data['role'];
	if ($_SESSION['role'] !== 1) {
		header("Location: ../index.php");
		exit();
	}

?>
<?php
		require_once('../admin/db.php');
		$id = $_GET['detailID'];
		$sql_2 = "SELECT * FROM account WHERE id = ?";

		$conn = connect_db();
		$stm = $conn->prepare($sql_2);
		$stm->bind_param("i", $id,);
		

		if (!$stm->execute()){
			die('can not execute: ' . $stm->error);
		}

		$result = $stm->get_result();
        $data = $result->fetch_assoc();

		$id = $data['id'];
		$username = $data['username'];
		$name = $data['name'];
		$email = $data['email'];
		$phone = $data['phone'];
		$level = $data['levels'];
		$phongban = $data['phongban'];
		$maPB = $data['MaPB'];
        $role = $data['role'];
        $gender = $data['gender'];
        $birthday = $data['birthday'];
        $cmnd = $data['cmnd'];
        $ethnic = $data['ethnic'];
        $nation = $data['nation'];
        $address = $data['address'];
        $image = $data['image'];
        $dayOff = $data['dayOff'];
        $dayOffUsed = $data['dayOffUsed'];
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="/style.css"> <!-- S??? d???ng link tuy???t ?????i t??nh t??? root, v?? v???y c?? d???u / ?????u ti??n -->
	<title>Manage Staff</title>
</head>
<body>
	<?php include '../partial/header.php'?>

	<header class="text-center bg-light text-info py-3 rounded">
        <h3 class="display-5 font-weight-bold">TH??NG TIN T??I KHO???N NH??N VI??N</h3>
     </header>

    <div class="container d-flex justify-content-center m-auto row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <img src="../images/<?= $image ?>" alt="" class="img-thumbnail w-80">
        </div>
        
        <div class="col-sm-12 col-md-8 col-lg-8 row">
            <div class="col-lg-6 col-md-12 col-sm-12">
				<div class="form-group">
                    <label for="">ID:</label>
                    <input type="text" class="form-control" placeholder="<?= $id ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">H??? v?? t??n:</label>
                    <input type="text" class="form-control" placeholder="<?= $name ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Username:</label>
                    <input type="text" class="form-control" placeholder="<?= $username ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input type="text" class="form-control" placeholder="<?= $email ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">S??? ??i???n tho???i:</label>
                    <input type="text" class="form-control" placeholder="<?= $phone ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">?????a ch???:</label>
                    <textarea type="text" class="form-control" placeholder="<?= $address ?>" disabled></textarea>
                </div>
                <div class="form-group">
                    <label for="">Gi???i t??nh:</label>
                    <input type="text" class="form-control" placeholder="<?php if($gender === 1){
						echo "Nam";
					}
                    if($gender === 2){
						echo "N???";
					} ;?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ng??y ngh??? ph??p:</label>
                    <input type="text" class="form-control" placeholder="<?= $dayOff ?>" disabled>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="">S??? ch???ng minh th??:</label>
                    <input type="text" class="form-control" placeholder="<?= $cmnd ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ng??y sinh:</label>
                    <input type="text" class="form-control" placeholder="<?= $birthday ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">D??n t???c:</label>
                    <input type="text" class="form-control" placeholder="<?= $ethnic ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ch???c V???:</label>
                    <input type="text" class="form-control" placeholder="<?= $level ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ph??ng ban:</label>
                    <input type="text" class="form-control" placeholder="<?= $phongban ?>" disabled>
                </div>
				<div class="form-group">
                    <label for="">M?? ph??ng ban:</label>
                    <input type="text" class="form-control" placeholder="<?= $maPB ?>" disabled>
                </div>
                
				<div class="form-group">
                    <label for="">Qu???c t???ch:</label>
                    <input type="text" class="form-control" placeholder="<?= $nation ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ng??y ???? ngh???:</label>
                    <input type="text" class="form-control" placeholder="<?= $dayOffUsed ?>" disabled>
                </div>
            </div>
            <div class="form-group ml-3">
                    <a href="./editUser.php?updateID=<?=  $id; ?>" class="btn btn-warning" >Ch???nh s???a</a>
                    <a href="./managestaff.php" class="btn btn-secondary "> Quay l???i </a>
					
                </div>
        </div>
    </div>
</div>
		




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/1542f0c587.js" crossorigin="anonymous"></script>
	<script src="/main.js"></script>
	<?php include '../partial/footer.php'?>

</body>
</html>