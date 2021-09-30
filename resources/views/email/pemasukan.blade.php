<!DOCTYPE html>
<html>
<head>
    <title>Informasi Pemasukan</title>
</head>
<body>
    <?php
    $date=date_create($details['tanggal']);
    $tgl = date_format($date,"d/F/Y");

    ?>
    <h2>{{ $details['title'] }}</h2>
    <p>{{ $details['body'] }}</p>
    <ul>
        <li> Nomor Pemasukan : {{ $details['id_pemasukan'] }}</li>
        <li> Nominal : {{ $details['nominal'] }}</li>
        <li> Keterangan : {{ $details['keterangan'] }}</li>
        <li> Tanggal : {{ $tgl }}</li>
        
    </ul>
   
    <p>Terima Kasih</p>
    <br>
    <p>Hormat Kami</p>
</body>
</html>