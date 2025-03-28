<?php
include('function.php');

if(!isset($_GET['section'])){
    header('Location: form.php');
    exit();
}
$section = $_GET['section'];
$result = $db->query("SELECT print_no FROM queues WHERE section = '$section'");
$row = $result->fetchArray();
$print_no = intval($row['print_no']) + 1;
$db->exec("UPDATE queues SET print_no = '$print_no' WHERE section = '$section'");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>No Antrian</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.print();
                window.close();
            }, 1000);
        });
    </script>
</head>

<body>
                <div class="card">
                    <div class="card-body">
                        <p class="text-center">No Antrian</p>
                        <h5 class="card-title text-center display-1 fw-bold" id="section-<?php echo $section; ?>"><?php echo strtoupper($section); ?><?php echo str_pad($print_no, 3, '0', STR_PAD_LEFT); ?></h5>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>