<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <a href='/'>Go Back Home</a>
    <h1>Viewing {{ $product['name'] }}</h1>
    <p>
        Name: {{ $product['name'] }} 
    </p>
    <p>
        Picture: {{ $product['picture'] }} 
    </p>
    <p>
        Price: {{ $product['price'] }} 
    </p>
    <p>
        Description: {{ $product['description'] }} 
    </p>
</body>
</html>