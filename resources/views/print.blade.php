<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>print</title>
</head>

<body>
    <div style="display: flex; flex-wrap:wrap; font-size:12px; font-weight:bold">
        @foreach ($materials as $material)
            <div class="" style="display: flex;  margin:10px 10px;">
                <img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('png')->size(37)->generate($material->no_material),
                ) !!}">
                <div
                    style="display:flex; flex-direction:column; width:3cm; border:1px solid black; align-items:center;  text-align:center; justify-content:center ">
                    <span style=" word-break: break-all; ">{{ $material->nama }}</span>
                    <span>{{ $material->no_material }}</span>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>

<script>
    window.print();
</script>
