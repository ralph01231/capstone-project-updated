<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    
    

</head>
        
<body>
    <div class="w-full h-screen"
        style="background-image: url('/images/firehouse-429754_1280.jpg'); background-size: cover;">
            {{ $slot }}
    </div>
</body>
    
</html>
