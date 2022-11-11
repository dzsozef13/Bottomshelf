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
    <div class="mx-auto w-screen bg-slate-500 flex p-4 items-center">
        <div class="w-14 h-14 bg-dim-white-900 rounded-full ml-4 "></div>
        <ul class="list-none flex items-center text-lg uppercase">
            <li>Home</li>
            <li>About</li>
        </ul>
    </div>
    <div class="" >
    {{content}}
    </div>
</body>
</html>