<?php
    require(__DIR__ . "/vendor/autoload.php");
    use GitHubWebhook\Handler;
    $handler = new Handler("ivan0vv0va", __DIR__);
    print_r($handler->getSecret());
    if($handler->handle()) {
        $commands = array(
            'echo $PWD',
            'whoami',
            'git fetch --all',
            'git checkout --force "origin/master"',
            'git status',
            'git submodule sync',
            'git submodule update',
            'git submodule status',
            'composer install',
        );

        // exec commands
        $output = '';
        foreach($commands AS $command){
            $tmp = shell_exec($command);
            
            $output .= "<span style=\"color: #6BE234;\">\$</span><span style=\"color: #729FCF;\">{$command}\n</span><br />";
            $output .= htmlentities(trim($tmp)) . "\n<br /><br />";
        }
    } else {
        $output = "<span style=\"color: #6BE234;\">\$</span><span style=\"color: #729FCF;\">Wrong secret\n</span><br />";
    }

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<div style="width:700px">
    <div style="float:left;width:350px;">
    <p style="color:white;">Git Deployment Script</p>
    <?php echo $output; ?>
    </div>
</div>
</body>
</html>