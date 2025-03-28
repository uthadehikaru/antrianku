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
    <div class="audio">
        <?php
            $list=audio_list();
            if(!empty($list))
            {
                foreach($list as $a)
                {
                    echo '<audio id="audio'.$a['ID'].'" class="audioitem" src="'.$a['path'].'"></audio>';
                }
            }
        ?>
        </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">No Antrian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                </ul>
            </div>
        </div>
    </nav>
    <section class="container mt-5">
        <div class="row">
            <?php foreach ($queues as $queue) : ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center display-1 fw-bold"><?php echo strtoupper($queue['section']); ?><?php echo str_pad($queue['queue_no'], 3, '0', STR_PAD_LEFT); ?></h5>
                        <p class="text-center">Antrian : <span id="print_no-<?php echo $queue['section']; ?>"><?php echo $queue['print_no']; ?></span></p>
						<div class="row g-2">
                            <div class="col-lg-6">
                                <button class="btn btn-primary w-100" onclick="panggil_urut('<?php echo $queue['section']; ?>',<?php echo $queue['queue_no']; ?>)">Panggil</button>
                            </div>
							<?php if($queue['print_no'] > $queue['queue_no']) : ?>
                            <div class="col-lg-6">
                                <a href="admin.php?section=<?php echo $queue['section']; ?>&action=next" class="btn btn-success w-100">Selanjutnya</a>
                            </div>
							<?php endif; ?>
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
    var totalwaktu = 0;
	
	//PLAY FRAMEWORK
	function play(id)
	{
		const playPromise=document.getElementById(id).play();
		if(playPromise !== null) // Jika tidak diblock browser, jalankan
		{
			playPromise.catch(() => {
				document.getElementById(id).pause();
				document.getElementById(id).currentTime=0;
				document.getElementById(id).play();
			})
		}
	}
	
	
 	function panggil_nomor(nomor)
	{
		totalwaktu=0;
		if(nomor < 1000) // File audio nya cuma bisa sampe 999 :D
		{
					
			if(nomor > 20) // Di audio file ada audio dari 1-20, jadi kita filter mulai dari 21
			{
				var satuan='';
				if(nomor.toString().length == 3) // Jika jumlah karakter 3 100-999
				{
					satuan='ratus'; //bikin satuan ratus
				}
				
				if(nomor > 20 && nomor < 100) // Bikin pemanggil puluhan
				{
					var b1=nomor.toString().substring(0,1); // Ambil karakter pertama misal 2
					var puluh=b1+'0'; //jadikan ke puluhan 10-90
					setTimeout(function(){ //setTimeout dibikin untuk stop periode audionya. 
						play('audio'+puluh+''); //play yg puluhan misal *dua puluh*
					},totalwaktu);
					totalwaktu=totalwaktu+1000; //Selalu tambahkan delay-nya
					
					var b2=nomor.toString().substring(1,2); //Ambil karakter 2
					if(b2 !='0') // Filter 0 terlebih dahulu, karena ada audio 10-90
					{
						setTimeout(function(){
							play('audio'+b2+''); //Mainkan karakter ke dua, Milal 3 "tiga"
						},totalwaktu);
						totalwaktu=totalwaktu+1000; //tambah delay
					}
					
				}
				
				if(satuan == 'ratus') // bikin pemanggil ratusan
				{
					var b1=nomor.toString().substring(0,1); //Ambil karakter pertama. Misal 2
					var ratus=b1+'00'; //jadikan ke ratusan 100-900. Misal 200 
					setTimeout(function(){
						play('audio'+ratus+''); //mainkan yg ratusan misal *dua ratus*
					},totalwaktu);				
					totalwaktu=totalwaktu+1200; //tambah delay
					
					
					//Panggil puluhan
					var b2=nomor.toString().substring(1,2); //Ambil karakter ke 2. Utk menentukan apakah 0 atau tidak. Contoh 234 karakter ke 2 nya adalah 3. Klo 204, maka karakter ke 2 nya adalah 0
					var b23=nomor.toString().substring(1,3); //Ambil karakter ke 2 dan 3. Menentukan apakah ini puluhan atau tidak. 234 jadi 34					
					var b3=nomor.toString().substring(2,3); //Ambil karakter ke 3. Klo b2 nilai 0 maka. Referensi b2
					
					if(b23 > 0) //jika karakter ke 2 dan 3 lebih dari 0
					{
						if(b23 > 20 && b23 < 100) // Filter yg ga ada audio 21-99
						{
							var bx1=b23.toString().substring(0,1); //Cari karakter 1 dari pecahan karakter ke 2 dan 3
							var puluh=bx1+'0'; //jadikan variable puluhan 10,20,30,dst
							setTimeout(function(){
								play('audio'+puluh+''); //mainkan puluh
							},totalwaktu);
							totalwaktu=totalwaktu+1000; //delay
							
							var bx23=b23.toString().substring(1,2); //Cari karakter 2 dari pecahan karakter ke 2 dan 3
							if(bx23 !='0' && !(b2 == '0' && b3 != '0')) //Filter jika tidak 0 dan bukan kasus seperti 608
							{
								setTimeout(function(){
									play('audio'+bx23+''); //Mainkan karakter ke 3
								},totalwaktu);
								totalwaktu=totalwaktu+1000; //Delay
							}
						}else if(b23 <= 10){ // Handle numbers 1-20
							setTimeout(function(){
								play('audio'+b3+''); //Play the complete number (1-10)
							},totalwaktu);
							totalwaktu=totalwaktu+1000;
						}else if(b23 <= 20){ // Handle numbers 1-20
							setTimeout(function(){
								play('audio'+b23+''); //Play the complete number (11-20)
							},totalwaktu);
							totalwaktu=totalwaktu+1000;
						}
					}
					
				}
				
			}else{
				setTimeout(function(){
					play('audio'+nomor+''); //Mainkan 1 sampai 20
				},totalwaktu);
				totalwaktu=0; //reset lg delay jd 0
			}
		}else{
			alert('Range 1 - 999');
		}
	}
	
	
	function panggil_urut(counter,nomor)
	{
        counter = counter.toLowerCase();
        play('audio'+counter+'');
        setTimeout(() => {
            panggil_nomor(nomor);
        }, 500);
		totalwaktu = 8568.163;
	}
	
	
	</script>
	
	<?php
	if($callQueue) {
	?>
		<script>
			panggil_urut('<?php echo $callQueue['section']; ?>',<?php echo $callQueue['queue_no']; ?>);
		</script>
	<?php
	}
	?>
	
<script>
function updateQueue() {
    // Update each section
    ['a', 'b', 'c'].forEach(section => {
        $.get('api.php?page=form&section=' + section, function(data) {
            // Pad number with leading zeros to 3 digits
            let paddedNumber = String(data);
            // Update display with section letter + padded number
            $('#print_no-' + section).text(paddedNumber);
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