<?php

$test = new Router();
?>

<body class="bodyStyle">
    <div class="grid grid-cols-6 h-screen">
        <div class="sm:col-span-2 xl:col-span-1 bg-highlight-green-900/10 p-8 flex flex-col justify-between">
            <div>
                <div class="logo"></div>
                <ul class="mt-6 uppercase">
                    <a href="/Dashboard">
                        <li class="mb-4 <?php if ($test->currentRoute === 'Dashboard') {
                                            echo 'text-highlight-green-900';
                                        } ?>">Dashboard</li>
                    </a>
                    <a href="/Explore">
                        <li class="mb-4 <?php if ($test->currentRoute === 'Explore') {
                                            echo 'text-highlight-green-900';
                                        } ?>">Explore</li>
                    </a>
                    <a href="/Profile">
                        <li class="mb-4 <?php if ($test->currentRoute === 'Profile') {
                                            echo 'text-highlight-green-900';
                                        } ?>">
                            My Profile</li>
                    </a>
                </ul>
            </div>
            <div class="w-full flex items-center">
                <div class="logo"></div>
                <h4 class="ml-6">Username</h4>
            </div>

        </div>
        <div class=" sm:col-span-4 xl:col-span-5  ">
            {{content}}
        </div>
    </div>
</body>