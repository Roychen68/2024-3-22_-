<?php
$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=web01","admin","1234");

$sql = "SELECT * FROM `tickets`";

$rows = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TableSheet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav"></div>
    
    <div class="out">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Phone</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($rows as $key => $row) {
            ?>
                <tr>
                    <th class="data"><?=$row['id']?></th>
                    <th class="data"><?=$row['firstname']?></th>
                    <th class="data"><?=$row['lastname']?></th>
                    <th class="data"><?=$row['phone']?></th>
                    <th class="data"><?=$row['password']?></th>
                    <th class="data"><button class="btn btn-warning" onclick="edit(<?=$row['id']?>)">update</button></th>
                    <th class="data"><button class="btn btn-danger" onclick="del(<?=$row['id']?>)">delete</button></th>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
    </div>
    <div class="box">
        <table class="table table-dark">
            <tr>
                <th>Id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Phone</th>
                <th>Password</th>
            </tr>
            <tr>
                <th class="id"></th>
                <th class="form-group">
                    <input type="text" class="form-control firstname">
                </th>
                <th class="form-group">
                    <input type="text" class="form-control lastname">
                </th>
                <th class="form-group">
                    <input type="text" class="form-control phone">
                </th>
                <th class="form-group">
                    <input type="text" class="form-control password">
                </th>
                <th>
                    <button class="btn btn-warning" id="update">update</button>
                </th>
            </tr>
        </table>
    </div>
</body>
</html>
<script src="jquery.js"></script>
<script>
    $(".nav").load("header.html")

    function del(id) {
        var check = confirm('are you sure you are going to delete this data')   
        if (check) {
            $.post("del.php",{id},function (res) {
                location.reload()
            })
        } else {
            
        }
    }

    let editid
    function edit(id) {
        let editid = id
        console.log(editid);
        $(".box").css("display","flex")
        $(".id").text(id)
        $.post("get.php",{id},function (res) {
            var data = JSON.parse(res)

            $(".firstname").val(data.firstname)
            $(".lastname").val(data.lastname)
            $(".phone").val(data.phone)
            $(".password").val(data.password)
        })
        $("#update").click(function () {
            var formdata={
            id: editid,
            firstname: $(".firstname").val(),
            lastname: $(".lastname").val(),
            phone: $(".phone").val(),
            password: $(".password").val()
            }
            $.post("update.php",formdata,function (res) {
                console.log(res);
                location.reload();
            })
        })
    }
</script>