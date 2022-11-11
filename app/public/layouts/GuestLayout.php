<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/output.css" rel="stylesheet">
    <title><?php echo $this->name ?></title>
</head>
<body class="bg-background-black-900 text-dim-white-900 font-sans">
    <div class="mx-auto w-screen flex pt-8 pb-4 px-8 items-center">
        <div class="w-full flex items-center">
            <div class="w-8 h-8 bg-dim-white-900 rounded-full ml-4 "></div>
            <ul class="list-none flex items-center text-m uppercase">
                <li class="mx-4 ml-6"><a href="/Home">Home</a></li>
                <li class="mx-2"><a href="/About">About</a></li>
            </ul>
        </div>
        <div class="w-40 h-8 bg-highlight-green-900 rounded border-0 text-background-black-900 font-mono"><button>Sign in</button></div>
    </div>
    <div class="mx-auto w-screen " >
    {{content}}
    </div>
</body>
</html>