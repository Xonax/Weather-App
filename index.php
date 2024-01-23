<?php
$city = 'Sint-Michielsgestel';
// API URL
$apiUrl = 'https://api.weatherapi.com/v1/forecast.json?key=72be9b1b12004327881131916242201&q=' . urlencode($city) . '&days=7&aqi=yes&alerts=no';

// Get the JSON response from the API
$response = file_get_contents($apiUrl);

// Check if the request was successful
if ($response === FALSE) {
    die('Error occurred while fetching the data.');
}

// Decode the JSON response
$data = json_decode($response, TRUE);

// Check if JSON decoding was successful
if ($data === NULL) {
    die('Error occurred while decoding JSON.');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.min.css" />
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/main.js" defer></script>r
    <script src="https://cdnjs.cloudflare.com/ajax/libs/suncalc/1.9.0/suncalc.min.js"></script>

</head>

<body>

</body>
<div class="container">
    <div class="row">
        <div class="col-lg-1">
            <header class="d-flex flex-lg-column align-items-center">
                <a href="/" class="logo">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 64 64">
                        <g transform="translate(5.796 8.927)">
                            <linearGradient id="a" gradientUnits="userSpaceOnUse" x1="-1714.548" y1="1855.346" x2="-1650.548" y2="1855.346" gradientTransform="rotate(-90 -1744.309 84.834)">
                                <stop offset="0" stop-color="#0bd1ff" />
                                <stop offset="1" stop-color="#1587ff" />
                            </linearGradient>
                            <path d="M58.204 40.073v-34c0-8.284-6.716-15-15-15h-34c-8.284 0-15 6.716-15 15v34c0 8.284 6.716 15 15 15h34c8.284 0 15-6.716 15-15z" fill="url(#a)" />
                            <linearGradient id="b" gradientUnits="userSpaceOnUse" x1="-925.303" y1="1069.467" x2="-925.303" y2="1089.969" gradientTransform="matrix(.7906 0 0 -.7906 747.858 868.585)">
                                <stop offset="0" stop-color="#ffef3f" />
                                <stop offset="1" stop-color="#ffc001" />
                            </linearGradient>
                            <path d="M24.622 19.119a8.301 8.301 0 1 1-8.301-8.301 8.301 8.301 0 0 1 8.301 8.301z" fill="url(#b)" />
                            <g opacity=".95" transform="matrix(.7906 0 0 .7906 -2.258 -780.06)">
                                <linearGradient id="c" gradientUnits="userSpaceOnUse" x1="-1149.195" y1="2328.906" x2="-1149.195" y2="2348.648" gradientTransform="matrix(.7906 0 0 -.7906 946.545 2865.39)">
                                    <stop offset="0" stop-color="#fff" />
                                    <stop offset="1" stop-color="#fff" stop-opacity=".755" />
                                </linearGradient>
                                <path d="M35 1004.362c-6.628 0-12 5.372-12 12v.156c-3.418.699-6 3.719-6 7.345a7.5 7.5 0 0 0 7.5 7.499c.166 0 .337-.021.5-.031v.031h24v-.031c5.562-.266 9.999-4.841 9.999-10.47 0-5.798-4.7-10.5-10.499-10.5-.996 0-1.962.147-2.874.406A12.019 12.019 0 0 0 35 1004.362z" fill="url(#c)" />
                            </g>
                        </g>
                    </svg>
                    Weather
                </a>
                <div class="line"></div>
                <ul class="d-flex flex-lg-column">
                    <li>
                        <a href="" class="active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="transparent" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <rect width="7" height="9" x="3" y="3" rx="1" />
                                    <rect width="7" height="5" x="14" y="3" rx="1" />
                                    <rect width="7" height="9" x="14" y="12" rx="1" />
                                    <rect width="7" height="5" x="3" y="16" rx="1" />
                                </g>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" fill="none">
                                <path fill="#ffffff" d="M16.9 1.09C16.6576 0.928937 16.3789 0.830871 16.089 0.804679C15.7992 0.778488 15.5073 0.824998 15.24 0.94L11.67 2.47L6.92 0.47C6.73338 0.390787 6.53273 0.349964 6.33 0.349964C6.12727 0.349964 5.92661 0.390787 5.74 0.47L1.38 2.31C1.04012 2.45783 0.751514 2.70282 0.55046 3.01418C0.349406 3.32555 0.244873 3.6894 0.25 4.06V15.31C0.24816 15.6262 0.32486 15.9379 0.473216 16.2172C0.621573 16.4965 0.836943 16.7345 1.1 16.91C1.3424 17.0711 1.62114 17.1691 1.91099 17.1953C2.20085 17.2215 2.49265 17.175 2.76 17.06L6.33 15.53L11.08 17.53C11.2661 17.6108 11.4671 17.6517 11.67 17.65C11.8727 17.6497 12.0733 17.6089 12.26 17.53L16.62 15.66C16.9599 15.5122 17.2485 15.2672 17.4495 14.9558C17.6506 14.6444 17.7551 14.2806 17.75 13.91V2.69C17.7518 2.37379 17.6751 2.06206 17.5268 1.7828C17.3784 1.50354 17.1631 1.26549 16.9 1.09ZM7.08 2.09L10.92 3.73V15.86L7.08 14.22V2.09ZM2.17 15.68C2.13199 15.7019 2.08888 15.7135 2.045 15.7135C2.00112 15.7135 1.958 15.7019 1.92 15.68C1.86422 15.641 1.81932 15.5883 1.78957 15.5271C1.75982 15.4658 1.7462 15.398 1.75 15.33V4.06C1.74878 3.98015 1.77209 3.90185 1.8168 3.83568C1.86151 3.76951 1.92546 3.71866 2 3.69L5.58 2.14V14.22L2.17 15.68ZM16.25 13.94C16.2537 14.0165 16.2348 14.0923 16.1957 14.1581C16.1566 14.2239 16.0989 14.2767 16.03 14.31L12.42 15.86V3.78L15.83 2.32C15.868 2.29806 15.9111 2.28651 15.955 2.28651C15.9989 2.28651 16.042 2.29806 16.08 2.32C16.1358 2.35905 16.1807 2.41169 16.2104 2.47294C16.2402 2.53419 16.2538 2.60201 16.25 2.67V13.94Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="" class="settings">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36">
                                <path fill="#ffffff" d="M18.1 11c-3.9 0-7 3.1-7 7s3.1 7 7 7s7-3.1 7-7s-3.1-7-7-7m0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5s5 2.2 5 5s-2.2 5-5 5" class="clr-i-outline clr-i-outline-path-1" />
                                <path fill="#ffffff" d="m32.8 14.7l-2.8-.9l-.6-1.5l1.4-2.6c.3-.6.2-1.4-.3-1.9l-2.4-2.4c-.5-.5-1.3-.6-1.9-.3l-2.6 1.4l-1.5-.6l-.9-2.8C21 2.5 20.4 2 19.7 2h-3.4c-.7 0-1.3.5-1.4 1.2L14 6c-.6.1-1.1.3-1.6.6L9.8 5.2c-.6-.3-1.4-.2-1.9.3L5.5 7.9c-.5.5-.6 1.3-.3 1.9l1.3 2.5c-.2.5-.4 1.1-.6 1.6l-2.8.9c-.6.2-1.1.8-1.1 1.5v3.4c0 .7.5 1.3 1.2 1.5l2.8.9l.6 1.5l-1.4 2.6c-.3.6-.2 1.4.3 1.9l2.4 2.4c.5.5 1.3.6 1.9.3l2.6-1.4l1.5.6l.9 2.9c.2.6.8 1.1 1.5 1.1h3.4c.7 0 1.3-.5 1.5-1.1l.9-2.9l1.5-.6l2.6 1.4c.6.3 1.4.2 1.9-.3l2.4-2.4c.5-.5.6-1.3.3-1.9l-1.4-2.6l.6-1.5l2.9-.9c.6-.2 1.1-.8 1.1-1.5v-3.4c0-.7-.5-1.4-1.2-1.6m-.8 4.7l-3.6 1.1l-.1.5l-.9 2.1l-.3.5l1.8 3.3l-2 2l-3.3-1.8l-.5.3c-.7.4-1.4.7-2.1.9l-.5.1l-1.1 3.6h-2.8l-1.1-3.6l-.5-.1l-2.1-.9l-.5-.3l-3.3 1.8l-2-2l1.8-3.3l-.3-.5c-.4-.7-.7-1.4-.9-2.1l-.1-.5L4 19.4v-2.8l3.4-1l.2-.5c.2-.8.5-1.5.9-2.2l.3-.5l-1.7-3.3l2-2l3.2 1.8l.5-.3c.7-.4 1.4-.7 2.2-.9l.5-.2L16.6 4h2.8l1.1 3.5l.5.2c.7.2 1.4.5 2.1.9l.5.3l3.3-1.8l2 2l-1.8 3.3l.3.5c.4.7.7 1.4.9 2.1l.1.5l3.6 1.1z" class="clr-i-outline clr-i-outline-path-2" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>

                        </a>
                    </li>
                </ul>
                <a href="" class="signature mt-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36">
                        <path fill="#ffffff" d="M18.1 11c-3.9 0-7 3.1-7 7s3.1 7 7 7s7-3.1 7-7s-3.1-7-7-7m0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5s5 2.2 5 5s-2.2 5-5 5" class="clr-i-outline clr-i-outline-path-1" />
                        <path fill="#ffffff" d="m32.8 14.7l-2.8-.9l-.6-1.5l1.4-2.6c.3-.6.2-1.4-.3-1.9l-2.4-2.4c-.5-.5-1.3-.6-1.9-.3l-2.6 1.4l-1.5-.6l-.9-2.8C21 2.5 20.4 2 19.7 2h-3.4c-.7 0-1.3.5-1.4 1.2L14 6c-.6.1-1.1.3-1.6.6L9.8 5.2c-.6-.3-1.4-.2-1.9.3L5.5 7.9c-.5.5-.6 1.3-.3 1.9l1.3 2.5c-.2.5-.4 1.1-.6 1.6l-2.8.9c-.6.2-1.1.8-1.1 1.5v3.4c0 .7.5 1.3 1.2 1.5l2.8.9l.6 1.5l-1.4 2.6c-.3.6-.2 1.4.3 1.9l2.4 2.4c.5.5 1.3.6 1.9.3l2.6-1.4l1.5.6l.9 2.9c.2.6.8 1.1 1.5 1.1h3.4c.7 0 1.3-.5 1.5-1.1l.9-2.9l1.5-.6l2.6 1.4c.6.3 1.4.2 1.9-.3l2.4-2.4c.5-.5.6-1.3.3-1.9l-1.4-2.6l.6-1.5l2.9-.9c.6-.2 1.1-.8 1.1-1.5v-3.4c0-.7-.5-1.4-1.2-1.6m-.8 4.7l-3.6 1.1l-.1.5l-.9 2.1l-.3.5l1.8 3.3l-2 2l-3.3-1.8l-.5.3c-.7.4-1.4.7-2.1.9l-.5.1l-1.1 3.6h-2.8l-1.1-3.6l-.5-.1l-2.1-.9l-.5-.3l-3.3 1.8l-2-2l1.8-3.3l-.3-.5c-.4-.7-.7-1.4-.9-2.1l-.1-.5L4 19.4v-2.8l3.4-1l.2-.5c.2-.8.5-1.5.9-2.2l.3-.5l-1.7-3.3l2-2l3.2 1.8l.5-.3c.7-.4 1.4-.7 2.2-.9l.5-.2L16.6 4h2.8l1.1 3.5l.5.2c.7.2 1.4.5 2.1.9l.5.3l3.3-1.8l2 2l-1.8 3.3l.3.5c.4.7.7 1.4.9 2.1l.1.5l3.6 1.1z" class="clr-i-outline clr-i-outline-path-2" />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg>

                </a>
            </header>
        </div>
        <div class="col-md-4 d-flex flex-column first-cards justify-content-start align-items-start">

            <div class="card">

                <!-- <pre><?php print_r($data); ?></pre> -->
                <?php
                $condition = $data['current']['condition']['text'];
                $isDay = $data['current']['is_day'];

                if ($condition == 'Sunny') {
                    echo '<img src="assets/images/sunny.png" alt="">';
                } elseif ($condition == 'Cloudy' || $condition == 'Overcast') {
                    echo '<img src="assets/images/cloudy.png" alt="">';
                } elseif ($condition == 'Clear' && $isDay == 1) {
                    echo '<img src="assets/images/sunny.png" alt="">';
                } elseif ($condition == 'Clear' && $isDay == 0) {
                    echo '<img src="assets/images/clear-night.png" alt="">';
                } elseif ($condition == 'Patchy rain possible' && $isDay == 1) {
                    echo '<img src="assets/images/sun-rain-chance.png" alt="">';
                } elseif ($condition == 'Patchy rain possible' && $isDay == 0) {
                    echo '<img src="assets/images/night-rain-chance.png" alt="">';
                } elseif ($condition == 'Patchy light drizzle' && $isDay == 0 || $condition == 'Light drizzle' && $isDay == 0) {
                    echo '<img src="assets/images/night-rain.png" alt="">';
                } elseif ($condition == 'Patchy light drizzle' && $isDay == 1 || $condition == 'Light drizzle' && $isDay == 1) {
                    echo '<img src="assets/images/rain.png" alt="">';
                }

                ?>

                <h1><?php echo $data['current']['temp_c'] ?><span>&#8451;</span></h1>
                <p><?php echo $data['current']['condition']['text'] ?></p>
                <div class="line"></div>
                <div class="d-flex mt-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="white" d="M12 2a9 9 0 0 1 9 9c0 3.074-1.676 5.59-3.442 7.395a20.441 20.441 0 0 1-2.876 2.416l-.426.29l-.2.133l-.377.24l-.336.205l-.416.242a1.874 1.874 0 0 1-1.854 0l-.416-.242l-.52-.32l-.192-.125l-.41-.273a20.638 20.638 0 0 1-3.093-2.566C4.676 16.589 3 14.074 3 11a9 9 0 0 1 9-9m0 2a7 7 0 0 0-7 7c0 2.322 1.272 4.36 2.871 5.996a18.03 18.03 0 0 0 2.222 1.91l.458.326c.148.103.29.199.427.288l.39.25l.343.209l.289.169l.455-.269l.367-.23c.195-.124.405-.263.627-.417l.458-.326a18.03 18.03 0 0 0 2.222-1.91C17.728 15.361 19 13.322 19 11a7 7 0 0 0-7-7m0 3a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 2a2 2 0 1 0 0 4a2 2 0 0 0 0-4" />
                        </g>
                    </svg>

                    <p><?php echo $data['location']['name'] ?>, <?php echo $data['location']['country'] ?></p>
                </div>
                <div class="d-flex mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="white" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1m5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1m0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1m-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1m7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3m1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1m0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1" />
                    </svg>
                    <p><?php echo date('d M, Y H:i', $data['location']['localtime_epoch']); ?></p>
                </div>
            </div>
            <div class="d-flex">
                <h6>7 days Forecast</h6>

            </div>
            <div class="card">
                <ul class="forecast">
                    <?php foreach ($data['forecast']['forecastday'] as $day) : ?>
                        <li>
                            <?php
                            $condition = $day['day']['condition']['text'];
                            $isDay = $data['current']['is_day'];

                            if ($condition == 'Sunny') {
                                echo '<img src="assets/images/sunny.png" alt="">';
                            } elseif ($condition == 'Cloudy' || $condition == 'Overcast') {
                                echo '<img src="assets/images/cloudy.png" alt="">';
                            } elseif ($condition == 'Clear' && $isDay == 1) {
                                echo '<img src="assets/images/sunny.png" alt="">';
                            } elseif ($condition == 'Clear' && $isDay == 0) {
                                echo '<img src="assets/images/clear-night.png" alt="">';
                            } elseif ($condition == 'Patchy rain possible' && $isDay == 1) {
                                echo '<img src="assets/images/sun-rain-chance.png" alt="">';
                            } elseif ($condition == 'Patchy rain possible' && $isDay == 0) {
                                echo '<img src="assets/images/night-rain-chance.png" alt="">';
                            } elseif ($condition == 'Patchy light drizzle' && $isDay == 0 || $condition == 'Light drizzle' && $isDay == 0) {
                                echo '<img src="assets/images/night-rain.png" alt="">';
                            } elseif ($condition == 'Patchy light drizzle' && $isDay == 1 || $condition == 'Light drizzle' && $isDay == 1) {
                                echo '<img src="assets/images/rain.png" alt="">';
                            } elseif ($condition == 'Partly cloudy' && $isDay == 1) {
                                echo '<img src="assets/images/partly-cloudy.png" alt="">';
                            } elseif ($condition == 'Partly cloudy' && $isDay == 0) {
                                echo '<img src="assets/images/night-partly-cloudy.png" alt="">';
                            }

                            ?>
                            <!-- <p><?php echo $condition ?></p> -->
                            <h3><?php echo $day['day']['maxtemp_c'] ?>°/<span><?php echo $day['day']['mintemp_c'] ?></span>
                            </h3>
                            <p class="date"><?php echo date("d M", $day['date_epoch'])  ?></p>
                            <p class="day"><?php echo date("l", $day['date_epoch'])  ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tomorrow d-flex">
                    <?php
                    $condition = $data['forecast']['forecastday'][1]['day']['condition']['text'];
                    $isDay = $data['current']['is_day'];

                    if ($condition == 'Sunny') {
                        echo '<img src="assets/images/sunny.png" alt="">';
                    } elseif ($condition == 'Cloudy' || $condition == 'Overcast') {
                        echo '<img src="assets/images/cloudy.png" alt="">';
                    } elseif ($condition == 'Clear' && $isDay == 1) {
                        echo '<img src="assets/images/sunny.png" alt="">';
                    } elseif ($condition == 'Clear' && $isDay == 0) {
                        echo '<img src="assets/images/clear-night.png" alt="">';
                    } elseif ($condition == 'Patchy rain possible' && $isDay == 1) {
                        echo '<img src="assets/images/sun-rain-chance.png" alt="">';
                    } elseif ($condition == 'Patchy rain possible' && $isDay == 0) {
                        echo '<img src="assets/images/night-rain-chance.png" alt="">';
                    } elseif ($condition == 'Patchy light drizzle' && $isDay == 0 || $condition == 'Light drizzle' && $isDay == 0) {
                        echo '<img src="assets/images/night-rain.png" alt="">';
                    } elseif ($condition == 'Patchy light drizzle' && $isDay == 1 || $condition == 'Light drizzle' && $isDay == 1) {
                        echo '<img src="assets/images/rain.png" alt="">';
                    } elseif ($condition == 'Partly cloudy' && $isDay == 1) {
                        echo '<img src="assets/images/partly-cloudy.png" alt="">';
                    } elseif ($condition == 'Partly cloudy' && $isDay == 0) {
                        echo '<img src="assets/images/night-partly-cloudy.png" alt="">';
                    }

                    ?>
                    <div class="d-flex flex-column justify-content-between ms-3">
                        <p>Tomorrow</p>
                        <h3><?php echo $data['forecast']['forecastday'][1]['day']['maxtemp_c'] ?>°</h3>
                        <p><?php echo  $data['forecast']['forecastday'][1]['day']['condition']['text'] ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<canvas id="sunriseSunsetChart" width="800" height="400"></canvas>


</html>