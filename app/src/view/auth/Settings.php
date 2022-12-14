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
/**
 * Color Scheme controller
 */
$colorSchemeController = new ColorSchemeController();

$userId = $sessionController->getUser()['userId'];
$profile = $userController->fetchById($userId);
$countries = $countryController->fetchAll();
$isAdmin = $profile->isAdmin();
$system = $systemController->fetchById(1);
$preselectedCountry = null;
$colorSchemes = $colorSchemeController->fetchAll();

foreach ($countries as $country) {
    if ($country->getCountryCode() === $profile->getCountryCode()) {
        $preselectedCountry = $country->getCountryName();
    }
}


?>
<div class="grid grid-cols-6 gap-8 px-8 w-full">
    <div class="col-span-6 2xl:h-[5vh] h-[5vh] ">
    </div>
    <div class="2xl:mx-20 mx-0 col-span-6 md:col-span-3 flex flex-col gap-4">
        <div class="banner-settings w-full">
            <h3 class="medium-headline w-full mb-4"><?php if ($isAdmin) {
                                                        echo '<span class="text-highlight-color-900">Admin </span>';
                                                    } ?>User Information</h3>
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
                <button class="btn-green-no-shadow w-full mt-4" name="submit" type="submit">UPDATE PICTURE</button>
            </form>
            <!-- Form with text fields -->
            <form action="UpdateUser" method="post" class="w-full h-auto flex flex-col mb-0">
                <p class="headline mt-6 mb-2">Account Details</p>
                <!-- Username -->
                <div class="input-field-wrapper mb-4">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input required placeholder="Username.." class="input-field " value="<?php echo $profile->getUsername() ?>" type="text" name="username">
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
                    <input placeholder="Country.." id="dropdown-container" class="input-field" type="text" name="countryName" value="<?php echo $preselectedCountry ?>" readonly="readonly">
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
                <button class="btn-green-no-shadow w-full mt-6" name="submit" type="submit">UPDATE USER INFORMATION</button>
            </form>
        </div>
    </div>
    <div class="2xl:mx-20 mx-0 col-span-6 md:col-span-3 flex flex-col gap-8">
        <div class="banner-settings w-full h-max">
            <h3 class="medium-headline w-full mb-2">Bottomshelf</h3>
            <div class="w-full flex flex-wrap mb-2">
                <p class="headline mr-2">We are based in:</p>
                <p class="text-highlight-color-900"><?php echo $system->getAddress() ?></p>
            </div>
            <div class="w-full flex flex-wrap">
                <p class="headline mr-2 mb-2 w-full">Feel free to contact us through:</p>
                <div class="flex w-full mb-4 items-center">
                    <i class="las la-at mr-2  text-2xl"></i>
                    <p class="text-highlight-color-900"><?php echo $system->getEmail() ?></p>
                </div>
                <div class="flex w-full items-center">
                    <i class="las la-phone-volume mr-2 text-2xl"></i>
                    <p class="text-highlight-color-900"><?php echo $system->getPhoneNumber() ?></p>
                </div>
            </div>
        </div>
        <?php if ($isAdmin) { ?>
            <div class="banner-settings w-full h-full ">
                <h3 class="medium-headline w-full mb-4">Contact Information</h3>
                <form action="UpdateContact" method="post" class="w-full h-full flex flex-col mb-0 justify-between">
                    <div class="w-full h-auto">
                        <!-- Email -->
                        <div class="input-field-wrapper mb-4">
                            <div class="icon-wrapper">
                                <i class="las la-at"></i>
                            </div>
                            <input required placeholder="Email.." class="input-field " value="<?php echo  $system->getEmail() ?>" type="text" name="email">
                        </div>
                        <!-- Phone Number -->
                        <div class="input-field-wrapper mb-4">
                            <div class="icon-wrapper">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <input required placeholder="Phone Number.." name="phoneNumber" class="input-field" value="<?php echo $system->getPhoneNumber() ?>" type="text">
                        </div>
                        <!-- Address -->
                        <div class="text-area-wrapper">
                            <div class="icon-wrapper-text-area">
                                <i class="las la-map-marker"></i>
                            </div>
                            <textarea required placeholder="Address.." name="address" maxlength="512" class="input-field  min-h-[4rem]"><?php echo $system->getAddress() ?></textarea>
                        </div>
                    </div>
                    <button class="btn-green-no-shadow  w-full mt-2 " name="submit" type="submit">UPDATE CONTACT</button>
                </form>
            </div>
        <?php }  ?>
    </div>
    <?php if ($isAdmin && !empty($colorSchemes)) { ?>
        <div class="2xl:mx-20 mx-0 col-span-6 mb-4 flex flex-col gap-8">
            <div class="banner-settings w-full">
                <h3 class="medium-headline w-full mb-4">Change The Global Color Scheme</h3>
                <form action="UpdateColorScheme" method="post" class="w-full h-auto flex flex-col mb-0">
                    <div class="w-full h-auto flex items-between gap-4 mb-4">
                        <?php foreach ($colorSchemes as $scheme) {
                            echo '
                        <div class="radio-input-wrapper"> 
                             <input type="radio" class="peer opacity-0 absolute" ' . ($scheme->getId() == $system->getColorSchemeId() ? 'checked' : "") . '  name="colorSchemeId" id="' . $scheme->getId() . '" value="' . $scheme->getId() . '">
                             <label class="label-radio-input" for="' . $scheme->getId() . '">' . $scheme->getColorSchemeName() . '</label>
                         </div>
                        ';
                        } ?>
                    </div>
                    <button class="btn-green-no-shadow  w-full mt-2" name="submit" type="submit">UPDATE SYSTEM COLOR SCHEME</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <?php if ($isAdmin) { ?>
        <div class="2xl:mx-20 mx-0 col-span-6 mb-4 flex flex-col gap-8">
            <div class="banner-settings w-full">
                <h3 class="medium-headline w-full mb-4">Description and Rules</h3>
                <form action="UpdateDescriptionRules" method="post" class="w-full h-auto flex flex-col mb-0">
                    <!-- Site description -->
                    <div class="sun-editor-wrapper mb-8 ">
                        <p class="mb-2 healine text-highlight-color-900">Description</p>
                        <textarea required id="settings-description" name="systemDescription"> <?php echo $system->getDescription() ?></textarea>
                    </div>
                    <!-- Rules -->
                    <div class="sun-editor-wrapper mb-4">
                        <p class="mb-2 healine text-highlight-color-900">Rules</p>
                        <textarea required id="settings-rules" name="rules"><?php echo $system->getRules() ?></textarea>
                    </div>
                    <button class="btn-green-no-shadow  w-full mt-2" name="submit" type="submit">UPDATE DESCRIPTION AND RULES</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>