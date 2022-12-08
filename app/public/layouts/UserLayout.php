<!-- to be finished -->

<body class="bodyStyle" id="body">
    <div class="grid grid-cols-6 min-h-screen relative">
        <div class="logo flex-none flex justify-center items-center z-20 fixed sm:absolute top-4 left-4 sm:top-8 sm:left-8" id="burger-menu">
            <i class="las la-bars text-background-black-900 text-xl flex sm:text-dim-white-900"></i>
        </div>
        <div class="col-span-6 sm:col-span-1 user-sidebar">
            <div class="h-auto w-full">
                <ul class="mt-14 uppercase text-xs md:text-base">
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
                        <li class="mb-0 sm:mb-4">
                            Log out</li>
                    </a>
                    <a href="/Upload" class="w-full h-auto hidden sm:flex">
                        <h4 class="">Create</h4>
                    </a>
                </ul>
            </div>
            <div class="w-full items-center relative break-all h-auto mt-10 sm:mt-0 hidden lg:flex">
                <div class="logo flex-none flex justify-center items-center">
                    <i class="las la-smile text-background-black-900 text-3xl"></i>
                </div>
                <a href="/Profile" class="w-full h-auto">
                    <h4 class="ml-4 ">{{username}}</h4>
                </a>
            </div>
        </div>
        <div class="col-span-6 sm:col-span-5 min-h-screen bg-[linear-gradient(180deg,_rgba(26,30,29,1)_0%,_rgba(24,26,26,1)_10%,_rgba(21,22,23,1)_20%)]">
            {{content}}
        </div>
    </div>
</body>