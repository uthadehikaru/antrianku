<?php
include('function.php')

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
</head>

<body>
    <?php include('navbar.php'); ?>
    <section class="container mt-5">
        <div class="row">
            <?php foreach ($queues as $queue) : ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center display-1 fw-bold" id="section-<?php echo $queue['section']; ?>"><?php echo strtoupper($queue['section']); ?><?php echo str_pad($queue['print_no'], 3, '0', STR_PAD_LEFT); ?></h5>
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <a href="print.php?section=<?php echo $queue['section']; ?>" target="_blank" class="btn btn-primary w-100">Cetak Antrian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
<script>
function updateQueue() {
    // Update each section
    ['a', 'b', 'c'].forEach(section => {
        $.get('api.php?page=form&section=' + section, function(data) {
            let print_no = (parseInt(data) + 1);
            // Pad number with leading zeros to 3 digits
            let paddedNumber = String(print_no).padStart(3, '0');
            // Update display with section letter + padded number
            $('#section-' + section).text(section.toUpperCase() + paddedNumber);
        });
    });
}

// Update initially
updateQueue();

// Update every 5 seconds
setInterval(updateQueue, 5000);
</script>


</body>

</html>