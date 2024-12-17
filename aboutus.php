<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    body{
    margin: 0;
    }
    .header-top {
        background-color: #55c595;
        padding-top: 0.1px;
    }
    .navigation {
        display: flex;
        justify-content: space-evenly;
    }

    .navigation a{
        padding-top: 15px;
        cursor: pointer;
        justify-content: center;
        align-items: center;
        text-align: center;
        border: none;
        text-decoration: none;
        color: white;
        width: 200px;
        height: 40px;
    }
    .navigation a:hover{
        color: black;
        background-color: whitesmoke;
        transition: 0.3s;
        border: none;
    }
    .img-flex {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 50px;
        }

        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 20px;
            padding: 20px;
            background-color: #fdfdfd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            width: 300px;
        }
        .profile-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #C4E4FF;
            margin-bottom: 15px;
        }

        .profile-card h1 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .profile-card p {
            font-size: 1.1em;
            color: #555;
        }

        .profile-card button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            background-color: #C4E4FF;
            cursor: pointer;
            transition: background-color 0.2s, box-shadow 0.2s;
        }

        .profile-card button:hover {
            background-color: #ff738b;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    .Bgsquare{
        background-color: #cfead8;
        display: flex;
        flex-wrap: wrap;
        margin: 55px 75px 75px 75px;
        border-radius: 15px;
    }

    .au{
        padding: 20px 30px 20px 30px;
        font-size: 25px;
    }
</style>
<body>
    <header class="header-top">
        <h1 style="text-align: center; color: white; cursor: pointer; display: inline; padding-left: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a href="weather.php">Weather</a>
            <a href="evacuationSite.php">Evacuation Site</a>
        </nav>
    </header>
    <h1 class="auTitle" style="color: #447262; padding-left: 12px;">About Us</h1>
    <h1 style="text-align: center;">Meet the Brogrammers Behind!</h1>
        <div class="img-flex">
            <div class="profile-card">
                <img src="Viktor.jpg" alt="">
                <h1>Viktor Greg A. Lim</h1>
                <p>Front-End Designer</p>
                <a href="https://www.facebook.com/V.Greg.lim" target="_blank"><button>Learn More</button></a>
            </div>

            <div class="profile-card">
                <img src="Anupol.jpg" alt="">
                <h1>Nur-Ali Anupol</h1>
                <p>Back-End Designer</p>
                <a href="https://www.facebook.com/john.mchales.buenaventura.2024" target="_blank"><button>Learn More</button></a>
            </div>
            <div class="profile-card">
                <img src="tappy.jpg" alt="">
                <h1>Lady Melodilluz Galope</h1>
                <p>Back-End Designer</p>
                <a href="https://www.facebook.com/john.mchales.buenaventura.2024" target="_blank"><button>Learn More</button></a>
            </div>
            <div class="profile-card">
                <img src="Clarence.jpg" alt="">
                <h1>Clarence Cabrera</h1>
                <p>Back-End Designer</p>
                <a href="https://www.facebook.com/john.mchales.buenaventura.2024" target="_blank"><button>Learn More</button></a>
            </div>
        </div>
    </div>
    <div class="Bgsquare">
        <div class="word">
            <p class="au">
                We are Zthink, a dedicated team passionate about helping people through websites.
                Our mission is to connect people during natural disasters,
                specifically during storms and floods. <br><br>

                Our platform aims to guide and assist affected individuals and communities that are affected by natural disasters and floods,
                and AguaTHINK is designed to act as a bridge between citizens and emergency responders. <br><br>

                AguaThink provides real-time updates on weather and users' current situation
                through posting on their accounts and resources for the communities in their time of need. <br><br>

                Be part of our initiative to connect with neighbors and other communities during storms and floods,
                providing mutual support during times of difficulty.
            </p>
        </div> 
    </div>

    
</body>
</html>
</body>
</html>