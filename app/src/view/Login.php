<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="col-span-2 flex flex-col justify-between pr-8">
        <div>
            <div class="pb-4">
                <h3 class="medium-headline mb-4">Sign in</h3>
                <p class="small-headline">Welcome back! Please enter your email and password</p>
            </div>
            <form action="UserLogin" method="post">
                <div>
                    <div class="label"> Email:</div>
                    <input type="text" name="email"><br>
                </div>
                <div>
                    <div class="label"> Password:</div>
                    <input type="password" name="password"><br>
                </div>
                <button class="btn w-full" type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="mb-8">
            <p class="small-headline mb-4">Don't have an account?</p>
            <button class="btn w-full">SIGN UP</button>
        </div>
    </div>
    <div class="col-span-4 bg-dim-white-900"></div>
</div>