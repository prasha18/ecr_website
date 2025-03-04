<?php
include("login_action.php");
user_log_vals();
require('api_integration.php');
$data = [
    "request_type" => "MEMBER",
    "device_id" => "string",
    "device_type" => "ANDROID",
    "device_token" => "string",
];
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="vendor/assets/images/favicon.ico">
    <title>LetsFAME Blog</title>
    <link href="vendor/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/popup_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="vendor/assets/node_modules/select2/dist/js/select2.min.js"></script>





    <style>
        /* Import Montserrat font from Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        /* Set the font family for Summernote */
        .note-editable {
            font-family: 'Montserrat', sans-serif;
            /* Use Montserrat font family */
        }

        .img-fluid {
            height: auto;
        }

        .thumbnail-preview {
            display: inline-block;
            margin-right: 10px;
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 5px;
        }

        .thumbnail-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #thumbnailContainer {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .popup--visible {
            display: block;
        }

        .popup__content {
            text-align: center;
        }

        .popup__background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 11px;
        }

        a.Updateimg,
        a.Updatevideo {
            text-decoration: underline !important;
            color: #fb9678 !important;
            float: inline-end !important;
        }
    </style>


</head>

<body class="skin-megna fixed-layout">
    <div id="main-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'side_menu.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <div class="row">
                            <div class="col-md-1 align-self-center text-end pe-0">
                                <img src="vendor/assets/images/favicon.ico" alt="user" class="img-fluid">
                            </div>
                            <div class="col-md-11 align-self-center">
                                <span class="text-themecolor">Book Artist</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 align-self-center text-end pe-3">
                        <a href="artist.php" class="btn btn-info text-white"><i class="fa fa-undo"
                                aria-hidden="true"></i> Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pb-3">
                                </div>
                                <h4 class="modal-title text-themecolor"> Add Book Artist</h4>
                            </div>
                            <?php

                            $sql = "SELECT * FROM book_artist where id=$id";

                            $result = $connect->query($sql);
                            foreach ($result as $geteditbloglist) {
                                ?>
                                <div class="modal-body pt-0">
                                    <form method="post" id="uploadFormsubmit" enctype="multipart/form-data">
                                        <div class="row card pt-0">
                                            <div class="col-lg-12 card-body pt-0">

                                                <div class="row">
                                                    <h5 class="modal-title text-themecolor pt-3">Basic Information<span
                                                            style="color:red;">*</span></h5>
                                                    <div class="col-md-6 pt-3">
                                                        <h4 class="card-title">Name <span style="color:red;">*</span></h4>
                                                        <input type="text" name="fullname" id="name" placeholder="Enter Name"
                                                            value="<?php echo $geteditbloglist['name']; ?>"
                                                            class="form-control" required>
                                                        <input type="hidden" name="id" placeholder="Enter Name"
                                                            value="<?php echo $id; ?>" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 pt-3">
                                                        <h4 class="card-title">Profession <span style="color:red;">*</span>
                                                        </h4>
                                                        <select id="profession" name="profession"
                                                            class="select2 form-control">
                                                            <option value="">Select Profession</option>
                                                            <option value="Actor" <?php if ($geteditbloglist['profession'] == "Actor") {
                                                                echo "selected";
                                                            } ?>>Actor</option>
                                                            <option value="Model" <?php if ($geteditbloglist['profession'] == "Model") {
                                                                echo "selected";
                                                            } ?>>Model</option>
                                                            <option value="Film Director" <?php if ($geteditbloglist['profession'] == "Film Director") {
                                                                echo "selected";
                                                            } ?>>Film Director</option>
                                                            <option value="Producer" <?php if ($geteditbloglist['profession'] == "Producer") {
                                                                echo "selected";
                                                            } ?>>Producer</option>
                                                            <option value="Film Editor" <?php if ($geteditbloglist['profession'] == "Film Editor") {
                                                                echo "selected";
                                                            } ?>>Film Editor</option>
                                                            <option value="Cinematographer" <?php if ($geteditbloglist['profession'] == "Cinematographer") {
                                                                echo "selected";
                                                            } ?>>Cinematographer</option>
                                                            <option value="Sound Engineer" <?php if ($geteditbloglist['profession'] == "Sound Engineer") {
                                                                echo "selected";
                                                            } ?>>Sound Engineer</option>
                                                            <option value="Script Writer" <?php if ($geteditbloglist['profession'] == "Script Writer") {
                                                                echo "selected";
                                                            } ?>>Script Writer</option>
                                                            <option value="Graphic Designer" <?php if ($geteditbloglist['profession'] == "Graphic Designer") {
                                                                echo "selected";
                                                            } ?>>Graphic Designer</option>
                                                            <option value="Singer" <?php if ($geteditbloglist['profession'] == "Singer") {
                                                                echo "selected";
                                                            } ?>>Singer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Country <span style="color:red;">*</span>
                                                        </h4>
                                                        <select id="country_name" name="country_name"
                                                            class="select2 form-control">
                                                            <option value="">Select Country</option>
                                                            <?php
                                                            $countryresponse = countryapiCallFunction($data);

                                                            if (isset($countryresponse['data']) && is_array($countryresponse['data'])) {
                                                                foreach ($countryresponse['data'] as $Countrylist) {
                                                                    // Check if the current country is selected
                                                                    $selected = (isset($geteditbloglist['country']) && $geteditbloglist['country'] == $Countrylist['name']) ? 'selected' : '';
                                                                    ?>
                                                                    <option
                                                                        value="<?php echo htmlspecialchars($Countrylist['name']); ?>"
                                                                        <?php echo $selected; ?>>
                                                                        <?php echo htmlspecialchars($Countrylist['name']); ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                            } else { ?>
                                                                <option value="">No Country available</option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">State <span style="color:red;">*</span></h4>
                                                        <select id="state" name="state_id" class="select2 form-control">
                                                            <option value="">Select State</option>
                                                            <?php
                                                            if (isset($geteditbloglist['country']) && !empty($geteditbloglist['country'])) {
                                                                $states = stateapiCallFunction($geteditbloglist['country']);
                                                                if (isset($states['data']) && is_array($states['data'])) {
                                                                    foreach ($states['data'] as $state) {
                                                                        $selected = ($geteditbloglist['state'] == $state['name']) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?php echo htmlspecialchars($state['name']); ?>"
                                                                            <?php echo $selected; ?>>
                                                                            <?php echo htmlspecialchars($state['name']); ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    echo '<option value="">No State available</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">Please select a State first</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">City <span style="color:red;">*</span></h4>
                                                        <select id="city" name="city_id" class="select2 form-control">
                                                            <option value="">Select City</option>
                                                            <?php
                                                            if (isset($geteditbloglist['state']) && !empty($geteditbloglist['state'])) {
                                                                $cities = cityapiCallFunction($geteditbloglist['country'], $geteditbloglist['state']);
                                                                if (isset($cities['data']) && is_array($cities['data'])) {
                                                                    foreach ($cities['data'] as $city) {
                                                                        $selected = ($geteditbloglist['city'] == $city['name']) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?php echo htmlspecialchars($city['name']); ?>"
                                                                            <?php echo $selected; ?>>
                                                                            <?php echo htmlspecialchars($city['name']); ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    echo '<option value="">No city available</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">Please select a city first</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Profile Image <span
                                                                style="color:red;">*</span></h4>
                                                                <input type="file" name="profile_img"  id="profile_img" class="form-control"
                                                                placeholder="Enter Profession" onchange="validateFileSize('profile_img', 500)" accept="image/*" >
                                                        <input type="hidden" name="edtprofile"
                                                            value="<?php echo $geteditbloglist['profile']; ?>"
                                                            class="form-control">
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 500kb.</p>
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 250 x 250px.</p>
                                                    </div>
                                                    <div class="col-md-2 pt-3">
                                                        <img src="<?php echo $geteditbloglist['profile']; ?>" alt="img"
                                                            class="img-fluid list-img">
                                                    </div>

                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Cover Image<span style="color:red;">*</span>
                                                        </h4>
                                                        <input type="file" name="banner_img"  id="banner_img" class="form-control" accept="image/*"  onchange="validateFileSize('banner_img', 500)" >
                                                        <input type="hidden" name="edtbanner"
                                                            value="<?php echo $geteditbloglist['banner']; ?>"
                                                            class="form-control">
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 500kb.</p>
                                                    </div>
                                                    <div class="col-md-2 pt-3">
                                                        <img src="<?php echo $geteditbloglist['banner']; ?>" alt="img"
                                                            class="img-fluid list-img">
                                                    </div>
                                                    <h5 class="modal-title text-themecolor pt-3">Biography / About
                                                        Information<span style="color:red;">*</span></h5>
                                                    <div class="col-md-12 pt-3">
                                                        <h4 class="card-title">About <span style="color:red;">*</span></h4>
                                                        <textarea name="content" maxlength="400" id="myTextarea" rows="4"
                                                            cols="175"><?php echo $geteditbloglist['about']; ?></textarea>
                                                        <div class="char-count" id="charCount">0 / 400 characters</div>

                                                    </div>


                                                    <h5 class="modal-title text-themecolor pt-3">Social Media - Instagram
                                                    </h5>

                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Instagram Image</h4>
                                                        <input type="file" name="insimg"  id="insimg"
                                                        placeholder="Enter Instagram Image " class="form-control" onchange="validateFileSize('insimg', 200)" accept="image/*">
                                                        <input type="hidden" name="edtinsimg"
                                                            value="<?php echo $geteditbloglist['insimg']; ?>"
                                                            class="form-control">
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 200kb.</p>
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 250 x 250px.</p>
                                                    </div>
                                                    <?php if (!empty($geteditbloglist['insimg'])) { ?>
                                                        <div class="col-md-2 pt-3">
                                                            <img src="<?php echo $geteditbloglist['insimg']; ?>" alt="img"
                                                                class="img-fluid list-img">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Instagram Name<span class="text-danger">*</span></h4>
                                                        
                                                        <input type="text" name="insname"
                                                            placeholder="Enter Instagram Name " id="instagram-name"
                                                            value="<?php echo $geteditbloglist['insname']; ?>"
                                                            class="form-control" required>
                                                    </div>
                                                    <!--<div class="col-md-6 pt-3">-->
                                                    <!--                            <h4 class="card-title">Instagram Url<span style="color:red;">*</span></h4> -->
                                                    <!--                            <input type="text" name="insurl" placeholder="Enter Instagram Url " value="<?php echo $geteditbloglist['insurl']; ?>"class="form-control" >-->
                                                    <!--                        </div>-->
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Instagram Followers Count<span class="text-danger">*</span></h4>
                                                        <input type="text" name="inscnt"
                                                            placeholder="Enter Instagram Followers Count "
                                                            value="<?php echo $geteditbloglist['inscnt']; ?>"
                                                            class="form-control" required>
                                                    </div>
                                                    <h5 class="modal-title text-themecolor pt-3">Social Media - Twitter</h5>

                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Twitter Image</h4>
                                                        <input type="file" name="faceimg"  id="faceimg" placeholder="Enter Twitter Image "
                                                        class="form-control" onchange="validateFileSize('faceimg', 200)" accept="image/*">
                                                        <input type="hidden" name="edtfaceimg"
                                                            value="<?php echo $geteditbloglist['faceimg']; ?>"
                                                            class="form-control">
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 200kb.</p>
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 250 x 250px.</p>
                                                    </div>
                                                    <?php if (!empty($geteditbloglist['insimg'])) { ?>
                                                        <div class="col-md-2 pt-3">
                                                            <img src="<?php echo $geteditbloglist['faceimg']; ?>" alt="img"
                                                                class="img-fluid list-img">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Twitter Name<span class="text-danger">*</span> </h4>
                                                        <input type="text" name="facename" placeholder="Enter Twitter Name " id="twitter-name"
                                                            value="<?php echo $geteditbloglist['facename']; ?>"
                                                            class="form-control" required>
                                                    </div>
                                                    <!--<div class="col-md-6 pt-3">-->
                                                    <!--                            <h4 class="card-title">Twitter Url<span style="color:red;">*</span></h4> -->
                                                    <!--                            <input type="text" name="faceurl" placeholder="Enter Twitter Url " value="<?php echo $geteditbloglist['faceurl']; ?>"class="form-control" >-->
                                                    <!--                        </div>-->
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Twitter Followers Count<span class="text-danger">*</span></h4>
                                                        <input type="text" name="facecnt"
                                                            placeholder="Enter Twitter Followers Count "
                                                            value="<?php echo $geteditbloglist['facecnt']; ?>"
                                                            class="form-control" required>
                                                    </div>

                                                    <h5 class="modal-title text-themecolor pt-3">Social Media - Youtube
                                                    </h5>

                                                    <div class="col-md-4 pt-3">
                                                        <h4 class="card-title">Youtube Image</h4>
                                                        <input type="file" name="youimg"  id="youimg" placeholder="Enter Youtube Image "
                                                            class="form-control" onchange="validateFileSize('youimg', 200)" accept="image/*">
                                                        <input type="hidden"  name="edtyouimg"
                                                            value="<?php echo $geteditbloglist['youimg']; ?>"
                                                            class="form-control">
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 200kb.</p>
                                                        <p class="text-muted mb-0"><span class="text-danger">*</span>Image
                                                            must be 250 x 250px.</p>
                                                    </div>
                                                    <?php if (!empty($geteditbloglist['insimg'])) { ?>
                                                        <div class="col-md-2 pt-3">
                                                            <img src="<?php echo $geteditbloglist['youimg']; ?>" alt="img"
                                                                class="img-fluid list-img">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Youtube Name<span class="text-danger">*</span></h4>
                                                        <input type="text" name="youname" id="youtube-name"  placeholder="Enter Youtube Name"
                                                            value="<?php echo $geteditbloglist['youname']; ?>"
                                                            class="form-control" required>
                                                    </div>
                                                    <!--<div class="col-md-6 pt-3">-->
                                                    <!--                            <h4 class="card-title">Youtube Url<span style="color:red;">*</span></h4> -->
                                                    <!--                            <input type="text" name="youurl" placeholder="Enter Youtube Url " value="<?php echo $geteditbloglist['youurl']; ?>"class="form-control" >-->
                                                    <!--                        </div>-->
                                                    <div class="col-md-3 pt-3">
                                                        <h4 class="card-title">Youtube Followers Count<span class="text-danger">*</span></h4>
                                                        <input type="text" name="youcnt"
                                                            placeholder="Enter Youtube Followers Count "
                                                            value="<?php echo $geteditbloglist['youcnt']; ?>"
                                                            class="form-control" required>
                                                    </div>

                                                    <h5 class="modal-title text-themecolor pt-3">Portfolio <span
                                                            style="color:red;">*</span></h5>
                                                    <div class="col-md-6 pt-3">
                                                        <h4 class="card-title">Photos <span style="color:red;">*</span>
                                                            <a class="Updateimg" href=""> <i class="fa fa-plus me-1"></i>Add
                                                                Photo</a>
                                                        </h4>

                                                        <!-- Image Container -->
                                                        <div id="imageContainer">
                                                            <?php
                                                            $sql = "SELECT * FROM book_artist_img WHERE bookid='$id'";
                                                            $result = $connect->query($sql);

                                                            foreach ($result as $row) {
                                                                if (isset($row)) {
                                                                    echo '<div style="position: relative; display: inline-block; margin: 10px;" id="img-' . htmlspecialchars($row['img_id']) . '">';
                                                                    echo '<img src="' . htmlspecialchars($row['imgurl']) . '" class="img-fluid me-3 " alt="Uploaded Image" style="width: 150px;height: 100px;">';
                                                                    echo '<button type="button" class="btn-close" aria-label="Close" style="position: absolute;top: -16px;right: -4px;" onclick="deleteImage(' . htmlspecialchars($row['img_id']) . ')"></button>';
                                                                    echo '</div>';
                                                                } else {
                                                                    echo '<p>No image uploaded yet.</p>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 pt-3">
                                                        <h4 class="card-title">Videos <span style="color:red;">*</span><a
                                                                href="" class="Updatevideo"><i
                                                                    class="fa fa-plus me-1"></i>Add Video</a></h4>
                                                        <div id="VideoContainer">
                                                            <?php
                                                            $sql = "SELECT * FROM book_artist_video WHERE bookid='$id'";
                                                            $result = $connect->query($sql);

                                                            foreach ($result as $row) {
                                                                if (isset($row)) {
                                                                    // Container for the image and buttons (close and play)
                                                                    echo '<div style="position: relative; display: inline-block; margin: 10px;">';

                                                                    // Thumbnail image with close button
                                                                    echo '<img src="' . htmlspecialchars($row['vid_thumbnail']) . '" class="img-fluid me-3" alt="Uploaded Image" style="width: 150px;height: 100px;">';

                                                                    // Close button (to delete video)
                                                                    echo '<button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: -16px; right: -4px;" onclick="deletevideo(' . htmlspecialchars($row['vid']) . ')"></button>';

                                                                    // Play button
                                                                    echo '<button type="button" class="btn btn-primary1" aria-label="Play" style="position: absolute; top: 48%; left: 48%; transform: translate(-50%, -50%);" data-url="' . htmlspecialchars($row['videourl']) . '"><i class="fa fa-play-circle" aria-hidden="true" style="font-size: 40px;"></i></button>';


                                                                    echo '</div>';
                                                                } else {
                                                                    echo '<p>No video uploaded yet.</p>';
                                                                }
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pt-3">
                                                        <h4 class="card-title">Status <span style="color:red;">*</span></h4>
                                                        <select class="form-select" name="status" required>
                                                            <option value="Active" <?php if ($geteditbloglist['status'] == "Active") {
                                                                echo "selected";
                                                            } ?>>Active</option>
                                                            <option value="In Active" <?php if ($geteditbloglist['status'] == "In Active") {
                                                                echo "selected";
                                                            } ?>>In Active</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 pt-5 text-end">

                                                        <div class="col-md-6 pt-5 text-end">
                                                            <button class="btn btn-info text-white px-4" name="update"
                                                                type="submit" id="submitButton">
                                                                <i class="pe-1 fa fa-plus-circle"></i> Add
                                                            </button>
                                                            <div id="loadingSpinner" style="display: none;">
                                                                <div class="spinner-border text-light" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
    <div class="popup popup--icon -success js_success-popup" style="display:none;">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">Success</h3>
            <p>Inserted Successfully</p>
        </div>
    </div>

    <!-- Error Popup -->
    <div class="popup popup--icon -error js_error-popup" style="display:none;">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">Error</h3>
            <p>Failed Successfully</p>
        </div>
    </div>
    <div id="MyPopupimg" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: 13px;
    right: 18px;"></button>
                    <h5 class="modal-title mx-auto  text-themecolor">Portfolio Photos</h5>
                </div>
                <div class="modal-body">
                    <form id="photoUploadForm" method="POST" enctype="multipart/form-data">
                        <div class="row card pt-0">
                            <div class="col-lg-12 card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 pt-3">
                                        <h4 class="card-title">Name <span style="color:red;">*</span></h4>
                                        <input type="text" name="phname" placeholder="Enter Name" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <h4 class="card-title">Photos <span style="color:red;">*</span></h4>
                                        <input type="file" name="phfile"  id="phfile"  onchange="validateFileSize('phfile', 500)"  class="form-control" accept="image/*" required>
                                        <p style="color:red;">Image must be 500kb.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info text-white px-4" name="updatephoto" id="updatephoto"
                                type="submit"><i class="pe-1 fa fa-plus-circle"></i> Add </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div id="MyPopupvideo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: 13px;
    right: 18px;"></button>
                    <h5 class="modal-title mx-auto text-themecolor">Portfolio Video</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="uploadForm" enctype="multipart/form-data">
                        <div class="row card pt-0">
                            <div class="col-lg-12 card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 pt-3">
                                        <h4 class="card-title">Description <span style="color:red;">*</span></h4>
                                        <input type="text" name="vidname" id="vidname" placeholder="Enter Name"
                                            class="form-control" required>
                                        <input type="hidden" name="bookid" id="bookid"
                                            value="<?php echo $_GET['id']; ?>" class="form-control" required>

                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <h4 class="card-title">Video <span style="color:red;">*</span></h4>
                                        <input type="file" name="vidfile" class="form-control" id="vidfile"
                                            accept="video/*" required>
                                        <div id="thumbnailContainer"></div>
                                        <p style="color:red;">Video must be 30mb.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info text-white px-4" id="uploadButton" type="submit">
                                <i class="pe-1 fa fa-plus-circle"></i> Add
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
    function setName() {
        let name = document.getElementById('name').value;

        if (name) {
            document.getElementById('youtube-name').value = name;
            document.getElementById('twitter-name').value = name;
            document.getElementById('instagram-name').value = name;
        }
    }
</script>
    <script>
    function validateFileSize(inputId, maxSizeKB) {
      const inputFile = document.getElementById(inputId);
      const maxSize = maxSizeKB * 1024; // Convert KB to Bytes
      if (!inputFile) {
        alert(`Input file with ID '${inputId}' not found.`);
        return false;
      }

      const file = inputFile.files[0];

      if (file && file.size > maxSize) {
        alert(`The uploaded file exceeds the maximum allowed size of ${maxSizeKB} KB.`);
        inputFile.value = ""; // Clear the input
        return false;
      }
      return true;
    }

    function validateAllFiles() {
      const profileValid = validateFileSize('profile_img', 500);
      const bannerValid = validateFileSize('banner_img', 500);
      const instaValid = validateFileSize('insimg', 200);
      const faceValid = validateFileSize('faceimg', 200);
      const youValid = validateFileSize('youimg', 200);

      return profileValid && bannerValid && instaValid && faceValid && youValid;
    }
  </script>


    <script>
        $(document).ready(function () {
            $('#uploadFormsubmit').on('submit', function (event) {
                event.preventDefault();

                var submitButton = $('#submitButton');
                var loadingSpinner = $('#loadingSpinner');

                // Disable the submit button and show the loading spinner
                submitButton.prop('disabled', true);
                submitButton.html('<i class="pe-1 fa fa-spinner fa-spin"></i> Submitting...');
                loadingSpinner.show();

                var formData = new FormData(this);

                $.ajax({
                    url: 'update_artist.php', // PHP file that processes the form
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Reset form fields
                        $('#uploadForm')[0].reset();

                        // Hide the loading spinner
                        loadingSpinner.hide();
                        submitButton.prop('disabled', false);
                        submitButton.html('<i class="pe-1 fa fa-plus-circle"></i> Add');

                        // Show success popup
                        showSuccessPopup();
                    },
                    error: function (xhr, status, error) {
                        // Hide the loading spinner and enable the submit button
                        loadingSpinner.hide();
                        submitButton.prop('disabled', false);
                        submitButton.html('<i class="pe-1 fa fa-plus-circle"></i> Add');

                        // Show error popup
                        showErrorPopup();
                    }
                });
            });

            // Function to show the success popup
            function showSuccessPopup() {
                // Show success popup
                $('.popup--success').addClass('popup--visible');
                setTimeout(function () {
                    // Redirect to 'artist.php' after 1 second
                    location.href = 'artist.php';
                }, 1000);
            }

            function showErrorPopup() {
                // Show error popup
                $('.popup--error').addClass('popup--visible');
                setTimeout(function () {
                    // Redirect to 'artist.php' after 1 second
                    location.href = 'artist.php';
                }, 1000);
            }
        });
    </script>

    <div id="videoModal"
        style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7);">
        <div style="position: relative; width: 60%; margin: auto; top: 20%;">
            <?php
            echo $row['vid'];
            $videoUrl = 'https://dev.letsfame.com/api/v1.0/video/17343483251259020-big_buck_bunny_720p_20mb.mp4';
            ?>

            <video id="videoElement" controls style="width: 100%;" src="<?php echo htmlspecialchars($videoUrl); ?>">
                Your browser does not support the video tag.
            </video>
            <button onclick="document.getElementById('videoModal').style.display='none'"
                style="position: absolute; top: -10px; right: -10px; font-size: 20px; background-color: transparent; color: white; border: none;">&times;</button>
        </div>
    </div>
    <script>
        const vidname = document.getElementById('vidname');
        const bookid = document.getElementById('bookid');
        const vidfile = document.getElementById('vidfile');
        const thumbnailContainer = document.getElementById('thumbnailContainer');
        const uploadButton = document.getElementById('uploadButton');

        // Event listener for file input
        vidfile.addEventListener('change', handleFileInput);

        // Function to get Bearer Token
        async function getBearerToken() {
            const apiUrl = 'https://dev.letsfame.com/api/v1.0/members/guest/token';
            const username = 'LetsFamez91';
            const password = '4h1r198a14s217i18t81';

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: 'Basic ' + btoa(username + ':' + password),
                },
                body: JSON.stringify({
                    request_type: 'MEMBER',
                    device_id: 'string',
                    device_type: 'ANDROID',
                    device_token: 'string',
                }),
            });

            const data = await response.json();
            if (response.ok && data.bearer_token) {
                return data.bearer_token;
            } else {
                throw new Error('Failed to fetch Bearer Token: ' + (data.message || response.statusText));
            }
        }

        // Function to upload file to the API
        async function uploadFileToApi(file, bearerToken, type = 'VIDEO') {
            const apiUrl = 'https://dev.letsfame.com/api/v1.0/files';
            const formData = new FormData();
            formData.append('file', file);
            formData.append('moderation_required', true);
            formData.append('type', type);

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + bearerToken,
                },
                body: formData,
            });

            const data = await response.json();
            if (response.ok && Array.isArray(data) && data.length > 0) {
                return data[0]; // Return the first file's details
            } else {
                throw new Error('File upload failed: ' + JSON.stringify(data));
            }
        }

        // Function to handle the file input
        async function handleFileInput(event) {
            const vidname = document.getElementById('vidname');
            const bookid = document.getElementById('bookid');
            const bookidValue = bookid.value; // Get value from bookid input field

            // Check if the video name (vidname) is empty
            if (!vidname.value.trim()) {
                alert('Please fill in the Description before uploading a file.');
                vidfile.value = ''; // Clear the file input field
                return; // Stop the process if vidname is empty
            }

            const files = event.target.files;
            if (!files.length) {
                console.error('No file selected.');
                return;
            }

            const videoFile = files[0];
            if (!videoFile.type.startsWith('video/')) {
                console.error('Selected file is not a video.');
                return;
            }

            uploadButton.innerHTML = 'Uploading...';

            try {
                const bearerToken = await getBearerToken();

                // Upload video
                const videoUploadResponse = await uploadFileToApi(videoFile, bearerToken, 'VIDEO');
                console.log('Video uploaded:', videoUploadResponse);

                // Generate and upload thumbnail
                const thumbnailUrl = await getThumbnailForVideo(URL.createObjectURL(videoFile));
                const thumbnailBlob = dataURItoBlob(thumbnailUrl);
                const thumbnailFile = new File([thumbnailBlob], 'thumbnail.png', { type: 'image/png' });

                const thumbnailUploadResponse = await uploadFileToApi(thumbnailFile, bearerToken, 'IMAGE');
                console.log('Thumbnail uploaded:', thumbnailUploadResponse);

                // Save details to the database
                const saveResponse = await saveVideoAndThumbnailDetails(videoUploadResponse, thumbnailUploadResponse, bookidValue);
                console.log('Data saved in database:', saveResponse);

                // Display uploaded thumbnail
                const img = document.createElement('img');
                img.src = thumbnailUploadResponse.url;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                thumbnailContainer.innerHTML = '';
                thumbnailContainer.appendChild(img);
                $('#MyPopupvideo').modal('hide');
                $('#uploadForm')[0].reset(); // Reset the form fields
                $('#thumbnailContainer').html(''); // Clear the thumbnail container
                fetchUpdatedVideos();
                console.log('bookidValue:', fetchUpdatedVideos(bookidValue));
            } catch (error) {
                console.error('Error during upload:', error);
                alert('Error uploading files: ' + error.message);
            } finally {
                uploadButton.innerHTML = 'Upload';
            }
        }

        // Function to save video and thumbnail details
        async function saveVideoAndThumbnailDetails(videoData, thumbnailData, bookidValue) {
            const apiUrl = 'video_upload.php';
            const videoName = vidname.value;

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    video_name: videoName,
                    bookid: bookidValue, // Use the bookidValue here
                    video: {
                        file_name: videoData.file_name,
                        original_file_name: videoData.original_file_name,
                        moderation_required: videoData.moderation_required,
                        type: videoData.type,
                        url: videoData.url,
                    },
                    thumbnail: {
                        file_name: thumbnailData.file_name,
                        original_file_name: thumbnailData.original_file_name,
                        moderation_required: thumbnailData.moderation_required,
                        type: thumbnailData.type,
                        url: thumbnailData.url,
                    },
                }),
            });

            const data = await response.json();
            if (!response.ok || !data.success) {
                throw new Error('Failed to save data: ' + (data.error || response.statusText));
            }

            return data;
        }

        // Function to convert data URI to Blob
        function dataURItoBlob(dataURI) {
            const byteString = atob(dataURI.split(',')[1]);
            const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            const arrayBuffer = new ArrayBuffer(byteString.length);
            const uintArray = new Uint8Array(arrayBuffer);

            for (let i = 0; i < byteString.length; i++) {
                uintArray[i] = byteString.charCodeAt(i);
            }

            return new Blob([uintArray], { type: mimeString });
        }

        // Function to get thumbnail for the video
        async function getThumbnailForVideo(videoUrl) {
            const video = document.createElement('video');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            video.style.display = 'none';
            canvas.style.display = 'none';

            return new Promise((resolve) => {
                video.addEventListener('loadedmetadata', () => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    video.currentTime = video.duration * 0.25; // Grab frame at 25% of the video
                });

                video.addEventListener('seeked', () => {
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    resolve(canvas.toDataURL('image/png'));
                });

                video.src = videoUrl;
            });
        }

        // Function to fetch updated videos
        function fetchUpdatedVideos() {
            const bookId = "<?php echo $_GET['id']; ?>"; // Fetching bookId from PHP
            $.ajax({
                url: 'fetch_videos.php', // PHP script to fetch updated videos
                type: 'GET',
                data: { id: bookId }, // Pass the actual bookId value
                success: function (response) {
                    console.log('Server Response:', response); // Log the response to check if it contains the expected data

                    try {
                        var data = JSON.parse(response); // Parse the JSON response
                        if (data.success) {
                            $('#VideoContainer').html(''); // Clear the current images
                            // Append the updated images
                            data.images.forEach(function (video) {
                                console.log(video, "video"); // Log each video object
                                var newVideoHTML = '<div style="position: relative; display: inline-block; margin: 10px;" id="vid-' + video.vid + '">';
                                newVideoHTML += '<img src="' + video.thumburl + '" class="img-fluid me-3" alt="' + video.description + '" style="width: 150px;height: 100px;">';
                                newVideoHTML += '<button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: -16px; right: -4px;" onclick="deletevideo(' + video.vid + ')"></button>';
                                newVideoHTML += '<button type="button" class="btn btn-primary1" aria-label="Play" style="position: absolute; top: 48%; left: 48%; transform: translate(-50%, -50%);" data-url="' + video.url + '"><i class="fa fa-play-circle" aria-hidden="true" style="font-size: 40px;"></i></button>';
                                newVideoHTML += '</div>';

                                $('#VideoContainer').append(newVideoHTML);
                            });
                        } else {
                            alert('Failed to fetch updated videos: ' + data.message);
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Error fetching updated videos.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching videos:', error); // Log any error
                    alert('Error fetching updated videos.');
                }
            });
        }

    </script>


    <script>
        // Function to play the video
        // function playVideo(url) {
        // var videoPlayer = document.createElement('video');
        // videoPlayer.src = url;
        // videoPlayer.controls = true;
        // document.body.appendChild(videoPlayer); // Or append to a specific element
        // videoPlayer.play();
        // }

        // function deleteVideo(videoId) {
        // $('#vid-' + videoId).remove(); // Remove video element from DOM
        // $.ajax({
        // url: 'delete_video.php', // PHP script to delete the video
        // type: 'POST',
        // data: { vid: videoId },
        // success: function(response) {
        // console.log('Video deleted successfully:', response);
        // fetchUpdatedVideos();
        // },
        // error: function(xhr, status, error) {
        // console.error('Error deleting video:', error);
        // alert('There was an error deleting the video.');
        // }
        // });
        // }




    </script>

    <script>
        $('#MyPopupvideo').on('click', '.btn-close', function () {
            $('#MyPopupvideo').modal('hide');
        });

    </script>
    <script>
        $('#MyPopupimg').on('click', '.btn-close', function () {
            $('#MyPopupimg').modal('hide');
        });

    </script>
    <script>
        function playVideo(videourl) {
            const videoUrl = videourl;

            const modal = document.getElementById('videoModal');
            const videoElement = document.getElementById('videoElement');
            videoElement.src = videoUrl;
            modal.style.display = 'block';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('videoModal');
            if (event.target === modal) {
                modal.style.display = 'none';
                const videoElement = document.getElementById('videoElement');
                videoElement.pause();
            }
        }
    </script>


    <script>
        function deletevideo(vid) {
            if (confirm('Are you sure you want to delete this Video?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_video.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Video deleted successfully.');
                        location.reload();
                    }
                };
                xhr.send('id=' + vid);
            }
        }
    </script>
    <script>
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_image.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Image deleted successfully.');
                        location.reload();
                    }
                };
                xhr.send('id=' + imageId);
            }
        }
    </script>
    </div>
    <script type="text/javascript">
        $(function () {
            // Show the modal when "Upload Photos" is clicked
            $("a[class='Updateimg']").click(function () {
                $("#MyPopupimg").modal("show");
                return false;
            });

            // Update image display dynamically after upload
            function updateImageDisplay(imgUrl, imgName, imgId) {
                var newImageHTML = '<div style="position: relative; display: inline-block; margin: 10px;" id="img-' + imgId + '"><img src="' + imgUrl + '" class="img-fluid me-3" alt="' + imgName + '" style="width: 150px;height: 100px;"><button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: -16px; right: -4px;" onclick="deleteImage(' + imgId + ')"></button></div>';
                $('#imageContainer').append(newImageHTML);
            }
            const updatephoto = document.getElementById('updatephoto');
            // Form submission for uploading the photo
            $("#photoUploadForm").submit(function (e) {
                e.preventDefault(); // Prevent form from submitting the traditional way
                updatephoto.innerHTML = '<div class="spinner"></div> Uploading...';
                var uploadBtn = $('#uploadBtn');
                uploadBtn.text('Uploading...'); // Change button text
                uploadBtn.prop('disabled', true); // Disable the button while uploading

                var formData = new FormData(this); // Create a FormData object to hold the form data

                $.ajax({
                    url: 'photo_upload.php', // PHP script to handle the upload
                    type: 'POST',
                    data: formData,
                    contentType: false, // Do not set content type for FormData
                    processData: false, // Do not process data for FormData
                    success: function (response) {
                        var data = JSON.parse(response); // Parse the response (assuming it contains image URL, description, and ID)

                        // If the upload is successful, update the image display
                        if (data.success) {
                            console.log(data, "hlo");
                            updateImageDisplay(data.url, data.description, data.img_id);
                            $('#MyPopupimg').modal('hide');
                            updatephoto.innerHTML = 'Add';
                            $('#photoUploadForm')[0].reset();
                        } else {
                            alert("Error uploading image: " + data.error_message);
                        }

                        uploadBtn.text('Upload'); // Reset the button text
                        uploadBtn.prop('disabled', false); // Enable the button again
                        updatephoto.innerHTML = 'Add';
                    },
                    error: function (xhr, status, error) {
                        alert("AJAX error: " + error);
                        uploadBtn.text('Upload'); // Reset the button text
                        uploadBtn.prop('disabled', false); // Enable the button again
                        updatephoto.innerHTML = 'Add';
                    }
                });
            });

            // Auto-refresh images from the server
            function fetchUpdatedImages() {
                $.ajax({
                    url: 'fetch_images.php', // PHP script to fetch updated images
                    type: 'GET',
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            $('#imageContainer').html(''); // Clear the current images
                            // Append the updated images
                            data.images.forEach(function (image) {
                                console.log(image, "image");
                                var newImageHTML = '<div style="position: relative; display: inline-block; margin: 10px;" id="img-' + image.img_id + '"><img src="' + image.url + '" class="img-fluid me-3" alt="' + image.description + '" style="width: 150px;height: 100px;"><button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: -16px; right: -4px;" onclick="deleteImage(' + image.img_id + ')"></button></div>';

                                $('#imageContainer').append(imageHTML);
                            });
                        } else {
                            alert('Failed to fetch updated images.');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Error fetching updated images.');
                    }
                });
            }

            // Auto-refresh images every 30 seconds
            // setInterval(fetchUpdatedImages, 30000);
        });


    </script>

    <script type="text/javascript">
        $(function () {
            $("a[class='Updatevideo']").click(function () {
                $("#MyPopupvideo").modal("show");
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize Select2
            // $('.select2').select2();

            // On change of country dropdown
            $('#country_name').change(function () {
                var country_name = $(this).val(); // Get selected country name

                // Check if a country is selected
                if (country_name) {
                    // Enable the state dropdown
                    $('#state').prop('disabled', false);

                    // Reset state and city dropdowns
                    $('#state').empty().append('<option value="">Select State</option>');
                    $('#city').empty().append('<option value="">Select City</option>').prop('disabled', true);

                    // AJAX request to fetch states based on country_name
                    $.ajax({
                        url: 'state_api_url.php', // Replace with your PHP file path
                        type: 'GET',
                        data: { country_name: country_name }, // Pass the country_name to the PHP file
                        dataType: 'json',
                        success: function (response) {
                            if (response.data && response.data.length > 0) {
                                // Populate state dropdown with response data
                                $.each(response.data, function (index, state) {
                                    $('#state').append('<option value="' + state.name + '">' + state.name + '</option>');
                                });
                            } else {
                                // No states available for selected country
                                $('#state').append('<option value="">No State available</option>');
                            }
                            // Reinitialize Select2 for the updated state dropdown
                            $('#state').select2();
                        },
                        error: function () {
                            // Handle error case
                            alert("Error fetching states. Please try again.");
                        }
                    });
                } else {
                    // If no country is selected, disable state and city dropdowns
                    $('#state').prop('disabled', true).empty().append('<option value="">Select State</option>');
                    $('#city').prop('disabled', true).empty().append('<option value="">Select City</option>');
                }
            });

            // On change of state dropdown
            $('#state').change(function () {
                var country_name = $('#country_name').val(); // Get the selected country name
                var state_name = $(this).val(); // Get the selected state name

                // Check if both country_name and state_name are selected
                if (country_name && state_name) {
                    // Enable the city dropdown
                    $('#city').prop('disabled', false);

                    // Reset city dropdown
                    $('#city').empty().append('<option value="">Select City</option>');

                    // AJAX request to fetch cities
                    $.ajax({
                        url: 'city_api_url.php', // Your PHP script
                        type: 'GET',
                        data: {
                            country_name: country_name,
                            state_name: state_name
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.data && response.data.length > 0) {
                                // Populate city dropdown with response data
                                $.each(response.data, function (index, city) {
                                    $('#city').append('<option value="' + city.name + '">' + city.name + '</option>');
                                });
                            } else {
                                $('#city').append('<option value="">No City available</option>');
                            }
                            // Reinitialize Select2 for the updated city dropdown
                            $('#city').select2();
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error); // Log the error
                            alert("Error fetching cities. Please try again.");
                        }
                    });
                } else {
                    // If no state is selected, disable city dropdown
                    $('#city').prop('disabled', true).empty().append('<option value="">Select City</option>');
                }
            });
        });

    </script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="vendor/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="vendor/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="vendor/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="vendor/dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="vendor/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="vendor/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="vendor/dist/js/custom.min.js"></script>
    <script src="vendor/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="vendor/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        // Date Picker
        jQuery('.mydatepicker').datepicker();
    </script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote

            });
        });
    </script>

</body>

</html>

<?php
// 								} 
// else {
//   echo '<script>window.location.href="login.php"</script>';	
// }
?>