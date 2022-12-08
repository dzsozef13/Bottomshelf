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


$userId = $sessionController->getUser()['userId'];
$profile = $userController->fetchById($userId);
$countries = $countryController->fetchAll();

$preselectedCountry = null;

foreach ($countries as $country) {
    if ($country->getCountryCode() === $profile->getCountryCode()) {
        $preselectedCountry = $country->getCountryName();
    }
}

?>
<div class="grid grid-cols-6 gap-4 px-8 w-full">
    <div class="col-span-6 2xl:h-[15vh] h-[25vh] ">
    </div>
    <div class="2xl:mx-20 mx-0 col-span-6 mb-4">
        <div class="banner-settings">
            <h3 class="medium-headline w-full">User Information</h3>
            <form action="" class="w-2/4 h-auto flex flex-col">
                <p class="headline">Current profile picture:</p>
                <div class="settings-preview-img ">
                    <img class="img" src="<?php if ($profile->getProfileImage() !== null) {
                                                echo $profile->getProfileImage();
                                            } else {
                                                echo "public/asset/images/PlaceholderProfilePicture.png";
                                            } ?>" alt="Users Profile Picture">
                </div>
                <div class="input-field-wrapper mt-6 mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-file-upload"></i>
                    </div>
                    <label class="w-full h-full flex items-center px-4  cursor-pointer text-sm text-highlight-green-900">
                        <input type="file" class="hidden" />
                        Profile Picture
                    </label>

                </div>
            </form>
            <form action="UpdateUser" method="post" class="w-2/4 h-auto flex flex-col">
                <div class="input-field-wrapper mt-6 mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input required placeholder="Username.." class="input-field " value="<?php echo $profile->getUsername() ?>" type="text" name="username"><br>
                </div>

                <div class="text-area-wrapper">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Bio description.." name="description" maxlength="256" class="input-field  min-h-[4rem]"><?php echo $profile->getDescription() ?></textarea>
                </div>
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

                <button class="btn-white w-full mt-6" type="submit">UPDATE USER INFORMATION</button>
            </form>

        </div>
    </div>
</div>