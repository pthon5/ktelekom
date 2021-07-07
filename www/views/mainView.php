
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Main</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <!--Start of card-->
    <div class="container-fluid">
        <div class="card">
        <div class="card-header">Добавление оборудования</div>
            <!--Form start-->
            <form class="form" method="POST" action="addDevice.php">
            <div class="row">

            <!--Textarea-->
            <div class="form-group">
            <label for="sn">Серийные номера:</label>
            <textarea id="sn" name="serials" class="form-control"></textarea>
            </div> 
            <!--End of textarea-->

            <!--Device type-->
            <div class="form-group">
                <label for="devType">Тип оборудования:</label>
                <select id="devType" name="devType">
                    <?php echo $devicesAtOptions; ?>
                </select>
            </div>
            <!--End of device type-->



            <div class="form-group col-sm-12 col-md-3 col-lg-3 float-right">
            <button class="btn btn-primary form-control" type="submit">Добавить</button>
            </div>
            </div>



            <!--Form end-->
            </form>

        <!--End of card-->
        </div>
    </div>
</body>

</html>