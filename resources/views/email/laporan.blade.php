<!DOCTYPE html>
<html>
<head>
    <title>Informasi Laporan</title>
</head>
<body>
    <?php
    $date=date_create($details['tanggal']);
    $tgl = date_format($date,"d/F/Y");

    ?>
    <h2>{{ $details['title'] }}</h2>
    <p>{{ $details['body'] }}</p>
    <ul>
        <li> Nomor Laporan : {{ $details['id_laporan'] }}</li>
        <li> Link : {{ $details['link'] }}</li>
        <li> Keterangan : {{ $details['keterangan'] }}</li>
        <li> Tanggal : {{ $tgl }}</li>
        
    </ul>
   
    <p>Terima Kasih</p>
    <br>
    <p>Hormat Kami</p>
</body>
</html>