<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="col-span-2 flex flex-col">
        <div class="pb-4">
            <h3 class="medium-headline">Sign in</h3>
            <p>Welcome back! Please enter your email and password</p>
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
            <button class="btn" type="submit">SIGN IN</button>

        </form>
        <div>
            <p>Don't have an account?</p>
            <button class="btn">SIGN UP</button>
        </div>
    </div>
    <div class="col-span-4 bg-dim-white-900"></div>
</div>