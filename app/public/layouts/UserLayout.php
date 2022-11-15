<body class="bodyStyle">
    <div class="grid grid-cols-6 h-screen">
        <div class="col-span-6 sm:col-span-3 xl:col-span-1 bg-highlight-green-900/10 p-8 flex flex-col justify-between">
            <div>
                <div class="logo"></div>
                <ul>
                    <a href="/Dashboard">
                        <li>Dashboard</li>
                    </a>
                    <a href="/Explore">
                        <li>Explore</li>
                    </a>
                    <a href="/Profile">
                        <li>My Profile</li>
                    </a>
                </ul>
            </div>
            <div class="w-full flex items-center">
                <div class="logo"></div>
                <h4 class="ml-6">Username</h4>
            </div>

        </div>
        <div class="col-span-6 sm:col-span-3 xl:col-span-5  ">
            {{content}}
        </div>
    </div>
</body>