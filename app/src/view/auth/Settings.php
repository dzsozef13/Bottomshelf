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

?>
<div class="grid grid-cols-6 gap-4 px-8 w-full">
    <div class="col-span-6 2xl:h-[15vh] h-[25vh] ">
    </div>
    <div class="2xl:mx-20 mx-0 col-span-6 mb-4">
        <div class="banner">
            <h3 class="medium-headline">User Information</h3>
            <form action="" class="w-full h-auto flex flex-col">

                <div class="input-field-wrapper mt-6">
                    <div class="icon-wrapper">
                        <i class="las la-user"></i>
                    </div>
                    <input placeholder="Username.." class="input-field " type="text" name="username"><br>
                </div>

                <div class="text-area-wrapper">
                    <div class="icon-wrapper-text-area">
                        <i class="las la-comment"></i>
                    </div>
                    <textarea placeholder="Bio description.." name="description" maxlength="256" class="input-field  min-h-[4rem]"></textarea>
                </div>
                <div class="dropdown-field-wrapper">
                    <div class="icon-wrapper">
                        <i class="las la-arrow-down"></i>
                    </div>
                    <input placeholder="Country.." id="dropdown-container" class="input-field" type="text" name="countryCode" value="<?php $profile->getCountryCode() ?>" readonly="readonly"><br>
                    <div class="dropdown absolute" id="dropdown">
                        <?php
                        foreach ($countries as $country) {
                            echo '
                        <div class="dropdown-button">' . $country->getCountryName() . '</div>
                        ';
                        }
                        ?>
                    </div>
                </div>

                <button class="btn-white w-full mt-6" type="submit">UPDATE</button>
            </form>
        </div>
    </div>
</div>