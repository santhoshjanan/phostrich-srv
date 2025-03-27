<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Doto:wght@100..900&display=swap');
        * {
            font-family: "Doto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "ROND" 100;
        }
        body, .text-light{
            background: cadetblue;
            color: aliceblue;
            text-decoration: none;
        }
        .title{
            display: flex;
            justify-content: center;
            font-weight: bold;
        }

        .title-h2{
            font-weight: 400;
        }

        .title-h3{
            font-weight: 100;
        }

        .underline-animate {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .underline-animate::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
            background-image: linear-gradient(to right, gold, goldenrod, lightgoldenrodyellow);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease-in-out;
        }

        .underline-animate:hover::after {
            transform: scaleX(1);
        }
    </style>
    <title>Phostrich &mdash; Nostr here!</title>
</head>
<body>
<h1 class="title">Phostrich</h1>
<h2 class="title title-h2">Think Nostr!</h2>
<h3 class="title title-h3"><a class="text-light underline-animate" href="https://zapmeacoffee.com/npub1dqcvgz20g2sn3venz47pxzjn2w6pf8xxs03vrrrwqp8z9lchce2ssj9fsy">Watch out for more..! ☕️ ☕️ ☕️️</a></h3>
</body>
</html>
