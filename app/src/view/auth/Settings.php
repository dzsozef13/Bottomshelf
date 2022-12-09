<?php

/**
 * Session controller
 */
$sessionController = new SessionController();
/**
 * User controller
 */
$userController = new UserController();
/**
 * Country controller
 */
$countryController = new CountryController();
/**
 * System controller
 */
$systemController = new SystemController();

$userId = $sessionController->getUser()['userId'];
$profile = $userController->fetchById($userId);
$countries = $countryController->fetchAll();
$isAdmin = $profile->isAdmin();
$system = $systemController->fetchById(1);
$preselectedCountry = null;

foreach ($countries as $country) {
    if ($country->getCountryCode() === $profile->getCountryCode()) {
        $preselectedCountry = $country->getCountryName();
    }
}

?>
<div class="grid grid-cols-6 gap-4 px-8 w-full">
    <div class="col-span-6 2xl:h-[5vh] h-[5vh] ">
    </div>
    <div class="2xl:mx-20 mx-0 col-span-3 mb-4 flex  flex-col  gap-4">
        <div class=" banner-settings w-full">
            <h3 class="medium-headline w-full mb-4">User Information</h3>
            <!-- Form for profile picture -->
            <form action="ChangeProfilePicture" enctype="multipart/form-data" method="post" class="w-full h-auto flex-wrap flex  mb-0" id="profile-img-upload">
                <!-- Image preview -->
                <div class="settings-preview-img">
                    <img class="img" src="<?php if ($profile->getProfileImage() !== null) {
                                                echo 'data:image/*;charset=utf8;base64,' . base64_encode($profile->getProfileImage());
                                            } else {
                                                echo "public/asset/images/PlaceholderProfilePicture.png";
                                            } ?>" alt="Users Profile Picture">
                </div>
                <!-- Image upload field -->
                <div class="w-4/5 flex flex-col h-auto justify-end pl-4">
                    <p class="headline">Profile picture</p>
                    <div class="input-field-wrapper cursor-pointer flex items-center px-4 upload-btn mt-2">
                        <div class="icon-wrapper">
                            <i class="las la-file-upload"></i>
                        </div>
                        <p id="input-text" class="m-0 p-0 text-sm">Upload image...</p>
                    </div>
                    <input type="file" id="html-upload-btn" class="hidden" name="profileImg" />
                </div>
                <button class="btn-white-no-shadow w-full mt-4" name="submit" type="submit">UPDATE PICTURE</button>
            </form>
            <!-- Form with text fields -->
            <form action="UpdateUser" method="post" class="w-full h-auto flex flex-col mb-0">
                <p class="headline mt-6 mb-2">Account Details</p>
                <!-- Username -->
                <div class="input-field-wrapper mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input required placeholder="Username.." class="input-field " value="<?php echo $profile->getUsername() ?>" type="text" name="username"><br>
                </div>
                <!-- Bio description -->
                <div class="text-area-wrapper">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Bio description.." name="description" maxlength="256" class="input-field  min-h-[4rem]"><?php echo $profile->getDescription() ?></textarea>
                </div>
                <!-- Country -->
                <div class="dropdown-field-wrapper">
                    <div class="icon-wrapper">
                        <i class="las la-arrow-down"></i>
                    </div>
                    <input placeholder="Country.." id="dropdown-container" class="input-field" type="text" name="countryName" value="<?php echo $preselectedCountry ?>" readonly="readonly"><br>
                    <div class="dropdown absolute" id="dropdown">
                        <?php
                        foreach ($countries as $country) {
                            echo '
                        <div class="dropdown-button" tabindex=0">' . $country->getCountryName() . '</div>
                        ';
                        }
                        ?>
                    </div>
                </div>
                <button class="btn-white w-full mt-6" name="submit" type="submit">UPDATE USER INFORMATION</button>
            </form>
        </div>
    </div>
    <div class="2xl:mx-20 mx-0 col-span-3 mb-4 flex flex-col gap-4">
        <div class="banner-settings w-full h-max">
            <h3 class="medium-headline w-full mb-2">Bottomshelf</h3>
            <div class="w-full flex flex-wrap mb-2">
                <p class="headline mr-2">We are based in:</p>
                <p class="text-highlight-green-900"><?php echo $system->getAddress() ?></p>
            </div>
            <div class="w-full flex flex-wrap">
                <p class="headline mr-2 mb-2 w-full">Feel free to contact us through:</p>
                <div class="flex w-full mb-4 items-center">
                    <i class="las la-at mr-2  text-2xl"></i>
                    <p class="text-highlight-green-900"><?php echo $system->getEmail() ?></p>
                </div>
                <div class="flex w-full items-center">
                    <i class="las la-phone-volume mr-2 text-2xl"></i>
                    <p class="text-highlight-green-900"><?php echo $system->getPhoneNumber() ?></p>
                </div>
            </div>

        </div>
        <?php
        if ($isAdmin) {
            echo ' <div class="banner-settings w-2/4">
                <h3 class="medium-headline w-full mb-4">Settings</h3>
            </div>';
        }
        ?>
    </div>
</div>