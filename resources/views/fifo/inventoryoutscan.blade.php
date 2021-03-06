<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Inventory Out Scanner</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light margin-bottom-5">
        <div class="container-fluid text">
            <img src="{{asset('assets/images/newlogo.png')}}" alt="Logo" height="40" class="d-inline-block align-text-top"> Scanner App
        </div>
      </nav>
    <div id="reader" width="400px" height="400px"></div>
      <div id="guide" class="col text-center">
        <h2>Klik tombol "Start Scanning" untuk mengaktifkan kamera</h2>
    </div>
</body>
</html>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function(){
    
    })

    function onScanSuccess(decodedText, decodedResult) {
        html5QrcodeScanner.pause();
        const result = decodedText;
        console.log(result)
        var url = "{{ route('targetedinventoryout.create', ':id') }}";
        url = url.replace(':id', result);
        window.location.href=url;
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: {width: 200, height:200}});
    html5QrcodeScanner.render(onScanSuccess);
</script>