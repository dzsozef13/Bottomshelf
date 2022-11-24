<!-- to be finished -->

<body class="bodyStyle">
    <div class="grid grid-cols-6 h-screen">
        <div class="col-span-1 bg-highlight-green-900/10 p-8 flex flex-col justify-between">
            <div>
                <div class="logo"></div>
                <ul class="mt-6 uppercase">
                    <a href="/Dashboard">
                        <li class="mb-4 <?php if ($_SERVER['REQUEST_URI'] === '/Dashboard') {
                                            echo 'text-highlight-green-900';
                                        } ?>">Dashboard</li>
                    </a>
                    <a href="/Explore">
                        <li class="mb-4 <?php if ($_SERVER['REQUEST_URI'] === '/Explore') {
                                            echo 'text-highlight-green-900';
                                        } ?>">Explore</li>
                    </a>
                    <a href="/Profile">
                        <li class="mb-4 <?php if ($_SERVER['REQUEST_URI'] === '/Profile') {
                                            echo 'text-highlight-green-900';
                                        } ?>">
                            My Profile</li>
                    </a>
                </ul>
            </div>
            <div class="w-full flex items-center relative">
                <div class="logo flex justify-center items-center">
                    <i class="las la-smile text-background-black-900 text-3xl"></i>
                </div>
                <h4 class="ml-4">{{username}}</h4>
            </div>
        </div>
        <div class="col-span-5">
            {{content}}
        </div>
    </div>
</body>