<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <title>Scanner QR Code</title>
</head>

<body>
    <style>
        #preview {
            display: block;
            margin-top: 100px;
            margin-left: auto;
            margin-right: auto;
            width: 500px;
            border: 3px solid green;
        }

        #buttons {
            width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <div class="">
        <video class="" id="preview"></video>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script type="text/javascript">
            var scanner = new Instascan.Scanner({
                video: document.getElementById('preview'),
                scanPeriod: 3,
                mirror: true
            });
            scanner.addListener('scan', function(content) {
               document.getElementById('data-qrcode').innerHTML = '<span class="result">' + content + "</span>";
            });
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change', function() {
                        if ($(this).val() == 1) {
                            if (cameras[0] != "") {
                                scanner.start(cameras[0]);
                            } else {
                                alert('No Front camera found!');
                            }
                        } else if ($(this).val() == 2) {
                            if (cameras[1] != "") {
                                scanner.start(cameras[1]);
                            } else {
                                alert('No Back camera found!');
                            }
                        }
                    });
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
                alert(e);
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"
            integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <div class="btn-group btn-group-toggle mb-5 d-flex justify-content-center" data-toggle="buttons" id="buttons">
            <label class="btn btn-success active">
                <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
            </label>
        </div>
        <div class="data-qrcode" id="data-qrcode" style="text-align: center"></div>
    </div>
</body>

</html>
