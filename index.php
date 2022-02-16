<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use roady\classes\component\UserInterface\WebUI;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Router;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\utility\AppBuilder;

$currentRequest = new Request(
    new Storable('CurrentRequest', 
        'Requests', 
        'Index'
    ), 
    new Switchable()
);

$appComponentsFactory = AppBuilder::getAppsAppComponentsFactory(
    basename(__DIR__), 
    $currentRequest->getUrl()
);

try {
    $userInterface = new WebUI(
        $appComponentsFactory->getPrimaryFactory()->buildStorable(
            'AppUI', 
            'Index'
        ),
        $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
        $appComponentsFactory->getPrimaryFactory()->buildPositionable(
            0
        ),
        new Router(
            $appComponentsFactory->getPrimaryFactory()->buildStorable(
                'AppRouter', 
                'Index'
            ),
            $appComponentsFactory->getPrimaryFactory()->buildSwitchable(),
            $currentRequest,
            $appComponentsFactory->getComponentCrud()
        )
    );
    echo $userInterface->getOutput();
} catch (RuntimeException $runtimeException) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your request could not be processed.</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        :root {
            --body-bg-color: #020203;
            --text-color: #00bbff;
            --link-active-color: #00ffc3;
            --link-color: #86dfff;
            --link-default-text-decoration: none;
            --link-hover-color: #33c9ff;
            --link-visited-color: #b9ecff;
            --font-family: 'Bebas Neue', cursive;
            --font-size: 2.02rem;
            --error-text-color: #ff4400;
        }

        body {
            background: var(--body-bg-color);
            color: var(--text-color);
            font-family: var(--font-family);
            font-size: var(--font-size);
            line-height: 2.1rem;
        }

        .roady-error {
            color: var(--error-text-color);
        }

        .roady-container {
            background-image: url('roadyLogo.png');
            background-size: 60% auto;
            background-repeat: no-repeat;
            background-position: center center;
            margin: 9rem auto;
            min-height: 25rem;
            text-align: center;
            rotate: -3deg;
        }

        .roady-content {
            background: black;
            opacity: .9;
            width: 30%;
            margin: 5rem auto;
            padding: 4rem;
        }

        .roady-container a {
            color: var(--link-color);
            text-decoration: var(--link-default-text-decoration);
        }

        .roady-container a:link {
            color: var(--link-color);
            text-decoration: var(--link-default-text-decoration);
        }

        .roady-container a:visited {
            color: var(--link-visited-color);
        }

        .roady-container a:hover {
            color: var(--link-hover-color);
            text-shadow: 2px 2px var(--body-bg-color);
        }

        .roady-container a:active {
            color: var(--link-active-color);
        }

        .roady-container h1 {
            text-shadow: -1px 1px #4bd5e7;
        }

    </style>
</head>
<body>
<div class="roady-container">
    <div class="roady-content">
        <h1 class="roady-error">
            <span style='font-size:5rem;'>&#128528;</span>
        </h1>
        <p>Sorry, your request could not be resolved.</p>
        <p>Request: 
            <a href="<?php echo $currentRequest->getUrl(); ?>">
                <?php echo $currentRequest->getUrl(); ?>
            </a>
        </p>
        <p class="roady-error">
            Reason:
            <?php echo $runtimeException->getMessage(); ?>
        </p>
    </div>
</div>
</body>
</html>
<?php } ?>
<!--

    Powered by Roady

    https://github.com/sevidmusic/roady

    https://roady.tech

-->
