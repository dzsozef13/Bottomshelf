<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title><?php echo $this->name ?></title>
</head>

<body class="bodyStyle">
    <div class="nav">
        <div class="w-full flex items-center">
            <div class="logo"></div>
            <ul class="list-none flex items-center text-m uppercase">
                <li class="mx-4 ml-6">
                    <a href="/Home">Home</a>
                </li>
                <li class="mx-2">
                    <a href="/About">About</a>
                </li>
            </ul>
        </div>
        <div class="btn-green">
            <a href="/Login">
                <button>Sign in</button>
            </a>
        </div>
    </div>
    <div class="mx-auto w-screen mt-20">
        {{content}}
    </div>
</body>

</html>