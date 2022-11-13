<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="col-span-2 flex flex-col justify-between pr-8">
        <div class="mt-12">
            <div class="pb-4">
                <h3 class="medium-headline mb-2">Sign in</h3>
                <p class="small-headline">Welcome back! Please enter your email and password</p>
            </div>
            <form action="UserLogin" method="post">
                <div class="input-field-wrapper">
                    <div class="icon-wrapper">
                        <i class="las la-at"></i>
                    </div>
                    <input placeholder="Email.." class="input-field" type="text" name="email"><br>
                </div>
                <div class="input-field-wrapper mt-4">
                    <div class="icon-wrapper">
                        <i class="las la-key"></i>
                    </div>
                    <input placeholder="Password.." class="input-field" type="password" name="password"><br>
                </div>
                <button class="btn-white w-full mt-5" type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="mb-8">
            <p class="small-headline mb-4">Don't have an account?</p>
            <button class="btn-green w-full">SIGN UP</button>
        </div>
    </div>
    <div class="col-span-4 bg-dim-white-900/20"></div>
</div>