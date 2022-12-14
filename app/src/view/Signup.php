<div class="grid grid-cols-6 px-8 h-[calc(100vh-5rem)]">
    <div class="w-screen h-screen absolute top-0 left-0 z-0 bg-[radial-gradient(circle_at_100%_100%,_rgba(144,202,156,0.111)_0%,_rgba(144,202,156,0.0)_58%)]">
    </div>
    <div class="col-span-6 sm:col-span-3 xl:col-span-2 flex flex-col justify-between sm:pr-8 relative z-1">
        <div class="mt-12">
            <div class="pb-6">
                <h3 class="medium-headline mb-2">Sign up</h3>
                <p class="small-headline">We're happy seeing you here.</p>
            </div>
            <form action="UserRegist" method="post">
                <div class="input-field-wrapper">
                    <div class="icon-wrapper">
                        <i class="las la-at"></i>
                    </div>
                    <input placeholder="Email.." class="input-field " type="text" name="email"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input placeholder="Username.." class="input-field " type="text" name="username"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-key"></i>
                    </div>
                    <input placeholder="Password.." class="input-field " type="password" name="password"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-key"></i>
                    </div>
                    <input placeholder="Repeat Password.." class="input-field " type="password" name="repeatPassword"><br>
                </div>
                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-birthday-cake"></i>
                    </div>
                    <input placeholder="Date of birth.." class="input-field " type="date" name="birthdate"><br>
                </div>
                <button class="btn-white w-full mt-6" type="submit">SIGN UP</button>
            </form>
        </div>
    </div>
    <div class="col-span-6 sm:col-span-3 2xl:col-span-4 "></div>
</div>
