<!-- to be finished -->

<body class="bodyStyle">
    <div class="grid grid-cols-6 min-h-screen">
        <div class="col-span-2 lg:col-span-1 bg-highlight-green-900/10 p-8 flex flex-col justify-between">
            <div class="h-auto w-full">
                <div class="logo"></div>
                <ul class="mt-6 uppercase">
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
                    <a href="">
                        <li class="mb-4">
                            Settings</li>
                    </a>
                    <a href="UserLogout">
                        <li class="mb-4">
                            Log out</li>
                    </a>
                </ul>
            </div>
            <div class="w-full flex items-center relative break-all h-auto ">
                <div class="logo flex-none flex justify-center items-center">
                    <i class="las la-plus text-background-black-900 text-3xl"></i>
                </div>
                <a href="/Upload" class="w-full h-auto">
                    <h4 class="ml-4 ">Create</h4>
                </a>
            </div>
            <div class="w-full flex items-center relative break-all h-auto ">
                <div class="logo flex-none flex justify-center items-center">
                    <i class="las la-smile text-background-black-900 text-3xl"></i>
                </div>
                <a href="/Profile" class="w-full h-auto">
                    <h4 class="ml-4 ">{{username}}</h4>
                </a>
            </div>
        </div>
        <div class="col-span-4 lg:col-span-5 min-h-screen bg-[linear-gradient(180deg,_rgba(26,30,29,1)_0%,_rgba(24,26,26,1)_10%,_rgba(21,22,23,1)_20%)]">
            {{content}}
        </div>
    </div>
</body>