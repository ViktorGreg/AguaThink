<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>donationHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header-top a{
    text-align: center; 
    text-decoration: none;
    font-size: 3em;
    font-weight: bold;
    color: white; 
    cursor: pointer; 
    display: inline; 
    padding-left: 15px;
}

.header-top{
    padding-top: 0.1px;
    background-color: #55c595;
    width: 100vw;
}
.navigation {
    display: flex;
    justify-content: space-evenly;

}
.navigation a:hover{
    color: black;
    background-color: whitesmoke;
    transition: 0.3s;
    border: none;
}
.navigation a{
    padding: 8px;
    z-index: 99;
    background-color: red;
    font-weight: bold;
    width: 25%;
    height: 30px;
    background: transparent;
    border: none;
    font-size: 15px;
}

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .donation1, .donation2, .donation3, .donation4 {
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            width: 100%;
            max-width: 300px; /* Limit the width */
            height: 100px;
            overflow: hidden;
            transition: height 0.3s ease; /* Smooth height change */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .donation1 a, .donation2 a, .donation3 a, .donation4 a{
            margin-top: 10px;
            text-decoration: none;

        }

        .donation1.expanded, .donation2.expanded, .donation3.expanded, .donation4.expanded {
            height: 300px;
        }

        .extra-content {
            display: none;
            margin-top: 10px;
            color: #333;
        }

        .donation1.expanded .extra-content,
        .donation2.expanded .extra-content,
        .donation3.expanded .extra-content,
        .donation4.expanded .extra-content {
            display: block;
        }

        button {
            width: 100%;
            padding: 8px 12px;
            background-color: #bfbfbf;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #55c595;
        }

        @media (max-width: 768px) {
            .donation1, .donation2, .donation3, .donation4 {
                width: 100%; /* Full width on smaller screens */
            }
        }

    </style>
</head>
<body>
<header class="header-top">
        <h1 style="font-size: 3em; text-align: center; color: white; cursor: pointer; display: inline; padding-left: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a onclick="openPop()">Add Post</a>
            <a href="weather.php">Weather</a>
            <a href="">Evacuation Site</a>
        </nav>
    </header>
    <h1 style="color: #447262; text-align: center; margin-top: 20px;">Donation Hub</h1>

    <div class="container">
        <div class="donation1">
            <h2>PHILIPPINE FLOOD HUB</h2> 
            <button onclick="toggleDiv(this)">Open</button><br>
            <p class="extra-content">Philippinee Flood Hub is a resource that provides information on floods globally, including real-time flood forecasts and alerts for the Philippines.</p>
            <a href="https://www.facebook.com/share/p/12C39xKZ8C4/">Donate Here</a>
        </div>
        <div class="donation2">
            <h2>GMA Kapuso Foundation</h2> 
            <button onclick="toggleDiv(this)">Open</button><br>
            <p class="extra-content">GMA Kapuso Foundation Inc. (formerly Bisig Bayan Foundation and GMA Foundation) is a socio-civic organization organized by GMA Network Inc. to facilitate social programs and outreach to the public.</p>
            <a href="https://www.gmanetwork.com/kapusofoundation/donate">Donate Here</a>
        </div>

        <div class="donation3">
            <h2>UNICEF PHILIPPINES</h2> 
            <button onclick="toggleDiv(this)">Open</button><br>
            <p class="extra-content">UNICEF's health program supports the Philippine Government’s Universal Health Care Agenda and poverty reduction initiatives to serve the poorest families and most vulnerable groups, particularly women and their newborn babies and beneficiaries of the conditional cash transfer program</p>
            <a href="https://donate.unicef.ph/campaign/champions?utm_source=google&utm_medium=cpc&utm_campaign=champions2023_sem&utm_content=branded_2&gad_source=1&gclid=CjwKCAiA6t-6BhA3EiwAltRFGA1Dy2aWPjNmtXJ5y962PNKHErZK-XTRl5h-CEc98LuDsE5sCWAmyxoCSaUQAvD_BwE">Donate Here</a>
        </div>
        <div class="donation4">
            <h2>CARITAS PHILIPPINES</h2> 
            <button onclick="toggleDiv(this)">Open</button><br>
            <p class="extra-content">Caritas Philippines is a non-profit organisation active in the Philippines, founded in 1966. It is the social arm of the Catholic Bishops' Conference of the Philippines and a member of the global Caritas Internationalis confederation and of its regional structure Caritas Asia.</p>
            <a href="https://www.facebook.com/OfficialCaritasManila/photos/we-would-like-to-remind-the-public-that-donations-can-be-made-to-us-through-gcas/964482965713224/?_rdr">Donate Here</a>
        </div>
    </div>

    <script>
        function toggleDiv(button) {
            const parentDiv = button.parentElement; // Get the parent div of the button
            parentDiv.classList.toggle('expanded'); // Toggle the 'expanded' class
        }

        
    </script>
</body>
</html>